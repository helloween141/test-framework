<?php

declare(strict_types=1);

namespace App\Framework;

use App\Framework\Di\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

class Bootstrap
{
    /**
     * @throws NotFoundException
     * @throws DependencyException
     * @throws \JsonException
     */
    public function run(): Response
    {
        try {
            $diContainer = (new Container())->create();
            $route = ($diContainer->get('Router'))->getRoute();

            if (isset($route['controller']) && isset($route['action'])) {
                $controller = $diContainer->get($route['controller']);
                $actionName = $route['action'] . 'Action';

                if (method_exists($controller, $actionName)) {
                    $response = $controller->$actionName();
                    return $this->createResponse($response, Response::HTTP_OK);
                }
            }
            return $this->createResponse(
                ['status' => 'failed', 'message' => 'Resource not found'],
                Response::HTTP_NOT_FOUND,
            );
        } catch (\Exception $e) {
            return $this->createResponse(
                ['status' => 'failed', 'message' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

    /**
     * @throws \JsonException
     */
    private function createResponse(array $content, int $status = 200): Response
    {
        return new Response(
            json_encode($content, JSON_THROW_ON_ERROR),
            $status,
            ['Content-type' => 'application/json;charset=utf-8'],
        );
    }
}
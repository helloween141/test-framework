<?php

declare(strict_types=1);

namespace App\Framework;

use App\Framework\Exception\RouterFileNotFoundException;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    private array $routesList = [];

    /**
     * @throws RouterFileNotFoundException
     */
    public function __construct(
        private readonly Request $request,
        private readonly string $filePath
    ) {
        if (!$filePath) {
            throw new RouterFileNotFoundException('Router file not found');
        }

        $this->routesList = require dirname(__DIR__, 2) . '/' . $filePath;
    }

    public function getRoute(): array
    {
        $currentRoute = $this->request->getRequestUri();

        foreach ($this->routesList as $route) {
            if ($route['path'] === $currentRoute) {
                return $route;
            }
        }

        return [];
    }
}
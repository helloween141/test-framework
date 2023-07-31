<?php

use App\Db\DbProvider;
use App\Framework\Router;
use Controller\ApiController;
use Controller\ProductController;
use Model\Repository\ApiRepository;
use Model\Repository\ProductRepository;
use Psr\Container\ContainerInterface;
use Service\ApiService;
use Service\ProductService;
use Symfony\Component\HttpFoundation\Request;
use App\Api\Api;
$config = require_once dirname(__DIR__) . '/config.php';

return [
    'DbProvider' => DI\Factory(function () use ($config) {
        return new DbProvider($config['db_path'] ?? '');
    }),
    'Request' => DI\Factory(function () {
        return Request::createFromGlobals();
    }),
    'Router' => function (ContainerInterface $c) use ($config) {
        return new Router($c->get('Request'), $config['routes_path'] ?? '');
    },
    'Api' => function () use ($config) {
        return new Api();
    },

    'ApiService' => function (ContainerInterface $c) {
        return new ApiService($c->get('ApiRepository'));
    },
    'ApiController' => function (ContainerInterface $c) {
        return new ApiController($c->get('ApiService'));
    },
    'ApiRepository' => function (ContainerInterface $c) {
        return new ApiRepository($c->get('Api'));
    },

    'ProductService' => function (ContainerInterface $c) {
        return new ProductService($c->get('ProductRepository'));
    },
    'ProductController' => function (ContainerInterface $c) {
        return new ProductController($c->get('ProductService'));
    },
    'ProductRepository' => function (ContainerInterface $c) {
        return new ProductRepository($c->get('DbProvider'));
    },
];
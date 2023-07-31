<?php

return [
    'get-products' => [
        'path' => '/products',
        'controller' => 'ProductController',
        'action' => 'info',
        'method' => 'GET'
    ],
    'get-users' => [
        'path' => '/users',
        'controller' => 'UserController',
        'method' => 'GET'
    ],
    'get-orders' => [
        'path' => '/orders',
        'controller' => 'OrderController',
        'method' => 'GET'
    ],
    'fetch-api-data' => [
        'path' => '/api/data',
        'controller' => 'ApiController',
        'action' => 'data',
        'method' => 'GET'
    ],
];
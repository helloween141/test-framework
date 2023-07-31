<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Db\DbProvider;

$db = (new DbProvider());

$users = [
    [
        ':name' => 'Ivanov Alexander'
    ],
    [
        ':name' => 'Smirnov Ivan'
    ],
];

foreach ($users as $user) {
    $db->insert('INSERT INTO users(name) VALUES (:name)', $user);
}

$products = [
    [
        ':title' => 'Macbook M1 Pro',
        ':price' => '80900'
    ],
    [
        ':title' => 'Macbook M2 Pro',
        ':price' => '120400'
    ],
];

foreach ($products as $product) {
    $db->insert('INSERT INTO products(title, price) VALUES (:title, :price)', $product);
}
<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Db\DbProvider;

$db = (new DbProvider());

$commands = [
    'CREATE TABLE IF NOT EXISTS users (
                        id   INTEGER PRIMARY KEY,
                        name VARCHAR(255) NOT NULL
    )',
    'CREATE TABLE IF NOT EXISTS products (
                    id INTEGER PRIMARY KEY,
                    title  VARCHAR (255) NOT NULL,
                    price  DOUBLE NOT NULL
    )',
    'CREATE TABLE IF NOT EXISTS orders (
                    id INTEGER PRIMARY KEY,
                    user_id  VARCHAR (255) NOT NULL,
                    product_id  FLOAT NOT NULL,
                    FOREIGN KEY (product_id)
                    REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE CASCADE,
                    FOREIGN KEY (user_id)
                    REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE
    )'
];

foreach ($commands as $command) {
    $db->execute($command);
}
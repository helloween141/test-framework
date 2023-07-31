<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

try {
    (new App\Framework\Bootstrap())
        ->run()
        ->send();
} catch (Exception $e) {
    throw new Exception($e->getMessage(), $e->getCode(), $e);
}
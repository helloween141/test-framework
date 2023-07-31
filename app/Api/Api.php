<?php

declare(strict_types=1);

namespace App\Api;

use App\Api\Exception\ApiException;

class Api
{
    public const API_HOST = 'https://dummyjson.com';

    public function fetchData(): array
    {
        $uri = self::API_HOST . '/products';

        if (!$data = @file_get_contents($uri)) {
            throw new ApiException('Can`t get data from API: ' . $uri);
        }

        $response = json_decode($data, true);

        return $response['products'] ?? [];
    }
}
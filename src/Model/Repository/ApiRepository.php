<?php

declare(strict_types=1);

namespace Model\Repository;

use App\Api\Api;

class ApiRepository
{
    public function __construct(private readonly Api $api) {
    }

    public function fetchAll(): array
    {
       return $this->api->fetchData();
    }
}
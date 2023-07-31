<?php

declare(strict_types=1);

namespace Service;

use Model\Repository\ApiRepository;

class ApiService
{
    public function __construct(
        private readonly ApiRepository $api,
    ) {
    }

    public function getAll(): array
    {
        return $this->api->fetchAll();
    }
}
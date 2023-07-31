<?php

declare(strict_types=1);

namespace Service;

use Model\Repository\OrderRepository;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $order,
    ) {
    }

    public function getAll(): array
    {
        return $this->order->fetchAll();
    }
}
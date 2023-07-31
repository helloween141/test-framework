<?php

declare(strict_types=1);

namespace Service;

use Model\Repository\ProductRepository;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $product,
    ) {
    }

    public function getAll(): array
    {
        return $this->product->fetchAll();
    }

    public function isExists(int $id): bool
    {
        return $this->product->exists($id);
    }

    public function add(string $title, float $price): int
    {
        return $this->product->add($title, $price);
    }

    public function edit(int $id, string $title, float $price): int
    {
        return $this->product->edit($id, $title, $price);
    }
}
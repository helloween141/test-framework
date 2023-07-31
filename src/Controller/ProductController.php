<?php

declare(strict_types=1);

namespace Controller;

use Service\ProductService;

class ProductController
{
    // TODO: передавать сервисы
    public function __construct(private readonly ProductService $productService) {
    }

    public function infoAction(): array
    {
        return $this->productService->getAll();
    }
}
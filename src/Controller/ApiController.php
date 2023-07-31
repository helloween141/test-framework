<?php

declare(strict_types=1);

namespace Controller;

use Controller\Dto\ProductDto;
use Service\ApiService;

class ApiController
{
    public function __construct(private readonly ApiService $apiService) {
    }

    public function dataAction(): array
    {
        $data = $this->apiService->getAll();
        $result = [];

        // TODO: use generator
        foreach ($data as $item) {
            $productDto = $this->transformToProductDto($item);
            $result[] = [
              'id' => $productDto->getId(),
              'title' => $productDto->getTitle(),
              'price' => $productDto->getPrice()
            ];
        }
        return $result;
    }

    private function transformToProductDto(array $item): ProductDto
    {
        return new ProductDto(
            $item['id'],
            $item['title'] ?? null,
            $item['price'] ?? 0,
        );
    }
}
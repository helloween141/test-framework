<?php

namespace Controller\Dto;

class ProductDto
{
    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly float $price
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
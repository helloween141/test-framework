<?php

namespace Model\Entity;

class Product
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price
        ];
    }

}
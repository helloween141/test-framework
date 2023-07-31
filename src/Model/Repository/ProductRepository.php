<?php

declare(strict_types=1);

namespace Model\Repository;

use App\Db\DbProvider;

class ProductRepository
{
    public function __construct(private readonly DbProvider $db)
    {
    }

    public function fetchAll(): array
    {
        return $this->db->fetchAll('SELECT * FROM products');
    }

    public function exists(int $id): bool
    {
        $query = 'select count(*) as cnt from products where id = :id';

        return $this->db->fetchAll($query, [':id' => $id])[0]['cnt'] > 0;
    }

    public function add(string $title, float $price): int
    {
        return $this->db->insert(
            'insert into products (title, price) values (:title, :price)',
            ['title' => $title, 'price' => $price],
        );
    }

    public function edit(int $id, string $title, float $price): int
    {
        return $this->db->execute(
            'update products set title = :name, price = :price where id = :id',
            ['id' => $id, 'title' => $title, 'price' => $price],
        );
    }
}
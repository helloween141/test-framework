<?php

declare(strict_types=1);

namespace Model\Repository;

use App\Db\DbProvider;

class UserRepository
{
    public function __construct(private readonly DbProvider $db) {
    }

    public function fetchAll(): array
    {
       return $this->db->fetchAll('SELECT * FROM users');
    }
}
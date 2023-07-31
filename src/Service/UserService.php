<?php

declare(strict_types=1);

namespace Service;

use Model\Repository\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $user,
    ) {
    }

    public function getAll(): array
    {
        return $this->user->fetchAll();
    }
}
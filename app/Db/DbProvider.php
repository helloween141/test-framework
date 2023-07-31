<?php

declare(strict_types=1);

namespace App\Db;

use App\Db\Exception\DbException;
use App\Db\Exception\DbFileNotFoundException;
use PDO;

class DbProvider
{
    private PDO $pdo;

    public function __construct(string $filePath)
    {
        if (!$filePath) {
            throw new DbFileNotFoundException('Db file not found');
        }

        $dbPath = dirname(__DIR__, 2) . '/' . $filePath;

        $this->pdo = new \PDO('sqlite:' . $dbPath);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchAll(string $query, array $params = []): array
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new DbException($e->errorInfo[2], $e->errorInfo[0], $e);
        }

        return $response ?: [];
    }

    public function execute(string $query, array $params = []): int
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return $statement->rowCount();
        } catch (\PDOException $e) {
            throw new DbException($e->errorInfo[2], $e->errorInfo[0], $e);
        }
    }

    public function insert(string $query, array $params = []): int
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return (int)$this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            throw new DbException($e->errorInfo[2], $e->errorInfo[0], $e);
        }
    }
}
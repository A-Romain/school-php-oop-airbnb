<?php

namespace ApertureCore;

use ApertureCore\Database\Database;
use ApertureCore\Database\DatabaseConfig;
use PDO;

abstract class Repository
{
    protected PDO $pdo;

    abstract protected function getTableName(): string;

    public function __construct(DatabaseConfig $config)
    {
        $this->pdo = Database::getPDO($config);
    }

    protected function readAll(string $class_name): array
    {
        $arrResult = [];

        $q = sprintf('SELECT * FROM `%s`;', $this->getTableName());

        $sth = $this->pdo->query($q);

        if (!$sth) return $arrResult;

        while ($row_data = $sth->fetch()) $arrResult[] = new $class_name($row_data);


        return $arrResult;
    }

    protected function readById(string $class_name, int $id): ?Model
    {
        $q = sprintf('SELECT * FROM `%s` where id = :id ;', $this->getTableName());

        $sth = $this->pdo->prepare($q);

        if (!$sth) return null;

        $sth->execute(['id' => $id]);

        $model = $sth->fetch();

        return !empty($model) ? new $class_name($model): null;

    }
}
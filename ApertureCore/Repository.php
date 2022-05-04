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

    /**
     * @param string $class_name
     * @param array $data
     * @return bool|null
     */
    public function insert(string $class_name, array $data)
    {
        $query_first_part = sprintf('INSERT INTO `%s` (', $this->getTableName());
        $query_second_part = ') VALUES (';
        $query_third_part = ');';

        foreach ($data as $column_name => $column_value) {
            $query_first_part .= "`$column_name`";
            $query_second_part .= "'$column_value'";

            if ($column_name !== array_key_last($data)) {
                $query_first_part .= ", ";
                $query_second_part .= ", ";
            }
        }

        $query = $query_first_part . $query_second_part . $query_third_part;

        $sth = $this->pdo->prepare($query);

        if (!$sth) return null;

        return $sth->execute(); // TODO: retourner la ligne inseree
    }
}
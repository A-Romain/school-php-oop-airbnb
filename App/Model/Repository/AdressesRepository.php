<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Adresses;

class AdressesRepository extends Repository
{
    protected function getTableName(): string{ return 'addresses'; }

    public function findAll() : array
    {
        return $this->readAll(Adresses::class);
    }

    public function findById( int $id ): ?Adresses
    {
        return $this->readById(Adresses::class, $id);
    }

    public function addreses(int $id): Adresses
    {
        $array = [];

        $q  = 'select * from addresses where id = :id;';

        $stmt = $this->pdo->prepare($q);

        $stmt->execute([':id'=>$id]);
        while ($row = $stmt->fetch())
        {
            $array = new Adresses($row);
        }
        return $array;
    }
}
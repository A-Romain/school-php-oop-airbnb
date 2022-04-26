<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Store;

class StoreRepository extends Repository
{
    protected function getTableName(): string{ return 'stores'; }

    public function findAll() : array
    {
        return $this->readAll(Store::class);
    }

    public function findById( int $id ) : ?Store
    {
        return $this->readById(Store::class, $id);
    }
}
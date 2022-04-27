<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Rentals;

class RentalsRepository extends Repository
{
    protected function getTableName(): string{ return 'stores'; }

    public function findAll() : array
    {
        return $this->readAll(Rentals::class);
    }

    public function findById( int $id ) : ?Rentals
    {
        return $this->readById(Rentals::class, $id);
    }
}
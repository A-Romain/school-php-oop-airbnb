<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Bookings;

class BookingsRepository extends Repository
{
    protected function getTableName(): string{ return 'bookings'; }

    public function findAll() : array
    {
        return $this->readAll(Bookings::class);
    }

    public function findById( int $id ) : ?Bookings
    {
        return $this->readById(Bookings::class, $id);
    }
}
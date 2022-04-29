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

    public function resabooking()
    {
        $q = 'insert into booking (user_id, rental_id, chek_in, chek_out) values (:user_id,:rental_id,:chek_in, :chek_out)';

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([
            ':user_id' => $_SESSION ['user_id'],
            'rental_id' => $_SESSION ['rental_id'],
            ':chek_in' => chek_in,
            ':chek_out' => chek_out,
        ]);
    }
}

<?php

namespace App\Model\Repository;

use ApertureCore\Model;
use ApertureCore\Repository;
use App\AppRepoManager;
use App\Model\Bookings;
use App\Model\Rentals;

class BookingsRepository extends Repository
{
    protected function getTableName(): string{ return 'bookings'; }

    public function findAll() : array
    {
        return $this->readAll(Bookings::class);
    }


    public function findById( int $id ) : ?Bookings
    {
        return $this->readById(Rentals::class, $id);
    }

    /**
     * @param array $data
     * @return false|string
     */
    public function resabooking(array $data)
    {
        $prepared_reservation_data = [
            'user_id' => $_SESSION['user_id'],
            'rental_id' => $_SESSION['rental_id'],
            'chek_in' => $data['chek_in'],
            'chek_out' => $data['chek_out'],
        ];

        $this->insert(Bookings::class, $prepared_reservation_data);

        return $this->pdo->lastInsertId();
    }


    /**
     * @param int $user_id
     * @return array
     */
    public function findByUserId(int $user_id)
    {

        $q = 'select * from bookings where user_id = :user_id';

        $stmt = $this->pdo->prepare($q);

        $stmt->execute(['user_id' => $user_id]);

        $data =[];

        while($row = $stmt->fetch()){
            $row_data = new Bookings($row);
            $row_data->rentals = AppRepoManager::getRm()->getRentalsRepository()->detail($row_data->rental_id);
            $data[] = $row_data;

        }

        return $data;
    }
}

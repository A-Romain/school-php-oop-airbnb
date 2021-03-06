<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Adresses;
use MongoDB\Driver\Exception\ServerException;

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

    /**
     * @param int $id
     * @return Adresses
     */
    public function addreses(int $id): ?Adresses
    {

        $q  = 'select * from addresses where id = :id;';

        $stmt = $this->pdo->prepare($q);

        $stmt->execute([':id'=>$id]);

        $row = $stmt->fetch();

        return  (!empty($row)) ? new Adresses($row):  null;

    }

    /**
     * @param int $user_id
     * @return array
     */
    public function findByAddressesId(int $user_id)
    {

        $q = 'select * from addresses where rental_id = :rental_id';

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

    /**
     * @param $data
     * @return false|string
     */
    public function ajoutAdresse($data)
    {
        $q = "INSERT INTO addresses (city, country) 
                VALUES (:city , :country);";

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([
            'city' => $data['city'],
            'country' => $data['country'],
        ]);
        return $this->pdo->lastInsertId();
    }

}
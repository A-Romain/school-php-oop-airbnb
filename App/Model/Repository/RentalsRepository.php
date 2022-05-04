<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\AppRepoManager;
use App\Controller\DetailController;
use App\Model\Adresses;
use App\Model\Rentals;

class RentalsRepository extends Repository
{
    protected function getTableName(): string{ return 'rentals'; }

    public function findAll() : array
    {
        return $this->readAll(Rentals::class);
    }

    public function findById( int $id ) : ?Rentals
    {
        return $this->readById(Rentals::class, $id);
    }

    /**
     * @return array
     */
    public function rentals(): array
    {
        $array = [];
        $q = 'select * from rentals;';

        $stmt = $this->pdo->query($q);

        while ($row = $stmt->fetch())
        {
            $rentals = new Rentals($row);
            $rentals->adresses =  AppRepoManager::getRm()->getAdressesRepository()->addreses($rentals->id);
            $rentals->equipement = AppRepoManager::getRm()->getEquipementRepository()->allEquipements($rentals->id);
            $array[] = $rentals;
        }
        return $array;

    }

    /**
     * @param string $owner_id
     * @return array
     */
    public function rentalsByUsers(string $owner_id)
    {
        $array = [];
        $query = sprintf("SELECT * FROM %s WHERE owner_id = :owner_id;", $this->getTableName());

        $sth = $this->pdo->prepare($query);

        $sth->execute(['owner_id' => $owner_id]);

        while ($row = $sth->fetch())
        {
            $detail = new Rentals($row);

            $detail->adresses = AppRepoManager::getRm()->getAdressesRepository()->addreses($detail->address_id);
            $detail->equipement = AppRepoManager::getRm()->getEquipementRepository()->allEquipements($detail->id);
            $array[] = $detail;
        }
        return $array;

    }

    /**
     * @param int $id
     * @return array
     */
    public function detail(int $id): array
    {
        $array = [];
        $q = 'select * from rentals where id = :id';

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':id'=>$id]);

        while ($row = $stmt->fetch())
        {
            $detail = new Rentals($row);
            $detail->adresses = AppRepoManager::getRm()->getAdressesRepository()->addreses($detail->id);
            $detail->equipement = AppRepoManager::getRm()->getEquipementRepository()->allEquipements($detail->id);
            $array[] = $detail;
        }
        return $array;
    }

    /**
     * @param $data
     * @return false|string
     */
    public function insertRental($data)
    {
        $prepared_data = [
            'owner_id' => $data['owner_id'],
            'type' => $data['type'],
            'surface' => $data['surface'],
            'description' => $data['description'],
            'capacity' =>  $data['capacity'],
            'price' => $data['price'],
            'address_id' => $data['address_id'],
        ];

        $this->insert(Rentals::class, $prepared_data);

        return $this->pdo->lastInsertId();
    }

}
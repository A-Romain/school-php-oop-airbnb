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

    public function  ajoutAnnonce($data)
    {
        $q = "INSERT INTO rentals ( owner_id, type, surface, description, capacity, price, address_id) 
                values (:owner_id, :type, :surface, :description, :capacity, :price, :address_id);";

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([
            'owner_id' => $_SESSION['user_id'],
            'type' => $data ['type'],
            'surface' => $data ['surface'],
            'description' => $data ['description'],
            'capacity' =>  $data['capacity'],
            'price' => $data['price'],
            'address_id' => address_id,
        ]);
    }

}
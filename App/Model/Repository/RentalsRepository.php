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
        $q = 'select * from rentals join rental_equipment re on rentals.id = re.rental_id
                join addresses a on a.id = rentals.address_id where rental_id = :id';

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':id'=>$id]);

        while ($row = $stmt->fetch())
        {
            $array[] = new Rentals($row);
        }
        return $array;
    }


}
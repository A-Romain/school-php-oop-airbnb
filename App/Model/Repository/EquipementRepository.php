<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Equipements;

class EquipementRepository extends Repository
{

    protected function getTableName(): string{ return 'equipments'; }

    public function findAll() : array
    {
        return $this->readAll(Equipements::class);
    }

    public function findById( int $id ) : ?Equipements
    {
        return $this->readById(Equipements::class, $id);
    }

    public function allEquipements(int $id): array
    {
        $array = [];

        $q = 'select id , label from equipments join rental_equipment re on equipments.id = re.equipment_id where rental_id = :id';

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([':id'=>$id]);

       while ($row = $stmt->fetch())
       {
           $array[] = new Equipements($row);
       }
       return $array;
    }


    public function ajoutEquipement()
    {
        $q = "INSERT INTO rental_equipment (rental_id, equipment_id) 
                VALUES (:rental_id, :equipment_id);";

        $stmt = $this->pdo->prepare($q);
        $stmt->execute([
           'rental_id' => rental_id,
           'equipment_id' => label ,
        ]);
    }


}


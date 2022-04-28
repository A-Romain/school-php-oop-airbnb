<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Toy;
use App\Model\Users;

class UsersRepository extends Repository
{

    protected function getTableName(): string{ return 'users'; }

    public function findAll() : array
    {
        return $this->readAll(Users::class);
    }

    public function findById( int $id ) : ?Users
    {
        return $this->readById(Users::class, $id);
    }

}
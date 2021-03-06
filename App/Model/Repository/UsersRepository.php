<?php

namespace App\Model\Repository;

use ApertureCore\Repository;
use App\Model\Toy;
use App\Model\Users;
use Couchbase\User;

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

    /**
     * Find user by email
     * @param string $email
     * @return Users|null
     */
    public function findByEmail(string $email): ?Users
    {
        $query = sprintf('SELECT * FROM `%s` where email = :email ;', $this->getTableName());

        $statement_handle = $this->pdo->prepare($query);

        if (!$statement_handle) return null;

        $statement_handle->execute(['email' => $email]);

        $database_return = $statement_handle->fetch();

        //var_dump($statement_handle, $database_return);

        return !empty($database_return) ? new Users($database_return): null; // return the model
    }

    /**
     * @param string $email
     * @param string $password
     * @return Users|null
     */
    public function findUser(string $email, string $password)
    {
        $query = sprintf("SELECT * FROM %s WHERE email = :email AND password = :password;", $this->getTableName());

        $sth = $this->pdo->prepare($query);

        $sth->execute(['email' => $email, 'password' => $password]);

        $database_return = $sth->fetch();

        return !empty($database_return) ? new Users($database_return): null;
    }

}
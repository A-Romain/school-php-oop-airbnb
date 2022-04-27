<?php

namespace App;

use ApertureCore\RepositoryManager;
use App\Model\Repository\RentalsRepository;
use App\Model\Repository\UsersRepository;

class AppRepoManager
{
    use RepositoryManager;

    private RentalsRepository  $storeRepository;
    private UsersRepository  $toyRepository;

    public function __construct()
    {
        $config = App::startApp();

        $this->storeRepository = new RentalsRepository($config);
        $this->toyRepository = new UsersRepository($config);
    }

    /**
     * @return RentalsRepository
     */
    public function getStoreRepository(): RentalsRepository
    {
        return $this->storeRepository;
    }

    /**
     * @return UsersRepository
     */
    public function getToyRepository(): UsersRepository
    {
        return $this->toyRepository;
    }
}
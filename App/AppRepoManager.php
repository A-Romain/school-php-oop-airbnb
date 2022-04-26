<?php

namespace App;

use ApertureCore\RepositoryManager;
use App\Model\Repository\StoreRepository;
use App\Model\Repository\ToyRepository;

class AppRepoManager
{
    use RepositoryManager;

    private StoreRepository  $storeRepository;
    private ToyRepository  $toyRepository;

    public function __construct()
    {
        $config = App::startApp();

        $this->storeRepository = new StoreRepository($config);
        $this->toyRepository = new ToyRepository($config);
    }

    /**
     * @return StoreRepository
     */
    public function getStoreRepository(): StoreRepository
    {
        return $this->storeRepository;
    }

    /**
     * @return ToyRepository
     */
    public function getToyRepository(): ToyRepository
    {
        return $this->toyRepository;
    }
}
<?php

namespace App;

use ApertureCore\RepositoryManager;
use App\Model\Repository\AdressesRepository;
use App\Model\Repository\BookingsRepository;
use App\Model\Repository\EquipementRepository;
use App\Model\Repository\RentalsRepository;
use App\Model\Repository\UsersRepository;

class AppRepoManager
{
    use RepositoryManager;

    private RentalsRepository  $rentalsRepository;
    private UsersRepository  $usersRepository;
    private EquipementRepository $equipmentRepository;
    private BookingsRepository $bookingsRepository;
    private AdressesRepository $adressesRepository;

    public function __construct()
    {
        $config = App::startApp();

        $this->rentalsRepository = new RentalsRepository($config);
        $this->usersRepository = new UsersRepository($config);
        $this->equipmentRepository = new EquipementRepository($config);
        $this->bookingsRepository = new BookingsRepository($config);
        $this->adressesRepository = new AdressesRepository($config);
    }

    /**
     * @return RentalsRepository
     */
    public function getRentalsRepository(): RentalsRepository
    {
        return $this->rentalsRepository;
    }

    /**
     * @return UsersRepository
     */
    public function getUsersRepository(): UsersRepository
    {
        return $this->usersRepository;
    }

    /**
     * @return EquipementRepository
     */
    public function getEquipementRepository(): EquipementRepository
    {
        return $this->equipmentRepository;
    }

    /**
     * @return BookingsRepository
     */
    public function getBookingsRepository(): BookingsRepository
    {
        return $this->bookingsRepository;
    }

    /**
     * @return AdressesRepository
     */
    public function getAdressesRepository(): AdressesRepository
    {
        return $this->adressesRepository;
    }
}
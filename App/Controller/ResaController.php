<?php

namespace App\Controller;

use ApertureCore\Database\Database;
use ApertureCore\View;
use App\App;
use App\AppRepoManager;
use App\Model\Repository\UsersRepository;
use App\Model\Rentals;

class ResaController
{
    public function index(): void
    {

        $view = new View('pages/reservation');
        $view->title = 'Reservation';

        $view->render();
    }

    public function formResa()
    {
        $view = new View('pages/reservation');
        $arr = AppRepoManager::getRm()->getBookingsRepository()->resabooking();

        $view_data = [
            'rentals' => $arr,
        ];
        $view->render($view_data);

    }

}
<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class ReservationController
{
    public function reservation(): void
    {
        $view_data = [
            'h1_tag' => 'Reservation',
        ];

        $view = new View('pages/reservation');
        $view->title = 'Reservation';

        $view->render($view_data);
    }


    public function formResa()
    {

        $_SESSION['user_id'] = 3;

        if(!empty($_POST)){

            AppRepoManager::getRm()->getBookingsRepository()->resabooking($_POST);

        }

        $array = AppRepoManager::getRm()->getBookingsRepository()->findByUserId($_SESSION['user_id']);

        $view = new View('pages/listeReservation');

        $view_data = [

            'rentals' => $array,
        ];

        $view->render($view_data);

    }


}
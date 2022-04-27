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
}
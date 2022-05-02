<?php

namespace App\Controller;

use ApertureCore\View;
use App\AppRepoManager;

class DetailController
{
    public function detail(): void
    {
        $view = new View('pages/detail');
        $view->title = 'Detail';

        $view->render();
    }

    public function detailRentals(int $id)
    {
        $_SESSION['user_id'] = 2;
        $_SESSION['rentals'] = $id;



        $view = new View('pages/detailAnnonce');
        $arr = AppRepoManager::getRm()->getRentalsRepository()->detail($id);

        $view_data = [
            'rentals' => $arr,
        ];

        if (!empty($_POST)){
            $view = new View('pages/listeReservation');
            AppRepoManager::getRm()->getBookingsRepository()->resabooking();

            $view_data = [
                'rentals' => $arr
            ];

        }

        $view->render($view_data);
    }
}
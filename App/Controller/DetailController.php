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

    /**
     * Route: /detail
     * Method: POST
     * Description: Permet de voir le detail d'une annonce a l'utilisateur
     */
    public function detailRentals(int $id)
    {
        $_SESSION['rental_id'] = $id;
        // Verifie si l'utilisateur est connecte
        if (!isset($_SESSION["user_id"])) {
            View::renderError(401);
            return;
        }

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
<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class AnnoncesController
{
    public function annonceAjout(): void
    {

        $view = new View('pages/ajoutAnnonce');
        $view->title = 'Annonces';

        $view->render();
    }

    public function listeRentals()
    {
        $view = new View('pages/listAnnonces');

        $arr = AppRepoManager::getRm()->getRentalsRepository()->rentals();


        $view_data = [
            'rentals' => $arr,
        ];
        $view->render($view_data);
    }

}
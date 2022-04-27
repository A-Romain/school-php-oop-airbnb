<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class AnnoncesController
{
    public function annonce(): void
    {
        $view_data = [
            'h1_tag' => 'Annonces',
        ];

        $view = new View('pages/listAnnonces');
        $view->title = 'Annonces';

        $view->render($view_data);
    }
}
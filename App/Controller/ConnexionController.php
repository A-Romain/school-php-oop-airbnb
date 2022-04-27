<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class ConnexionController
{
    public function index() : void
    {
        $view_data = [
            'h1_tag' => 'Connexion',

        ];

        $view = new View('pages/connexion');
        $view->title = 'Connexion';

        $view->render($view_data);

    }
}
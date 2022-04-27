<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class ConnexionController
{
    public function connexion() : void
    {

        $view = new View('pages/connexion');
        $view->title = 'Connexion';

        $view->render();

    }
}
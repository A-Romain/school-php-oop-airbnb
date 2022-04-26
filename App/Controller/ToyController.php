<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;

class ToyController
{
    public function index() : void
    {
        $view_data = [
            'h1_tag' => 'Nos jouets',
            'toys' => AppRepoManager::getRm()->getToyRepository()->findAll()
        ];

        $view = new View('pages/list');
        $view->title = 'Tous nos jouets';

        $view->render($view_data);

    }
}
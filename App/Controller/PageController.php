<?php

namespace App\Controller;

use ApertureCore\Database\Database;
use ApertureCore\View;
use App\App;
use App\AppRepoManager;
use App\Model\Repository\UsersRepository;
use App\Model\Rentals;

class PageController
{
    public function index(): void
    {

        $view = new View('pages/connexion');
        $view->title = 'Connexion';

        $view->render();
    }

    public function legalNotice(string $oui): void
    {
        echo 'Mentions illégales';
    }

    public function connexions(): void
    {
        $view = new View('pages/connexions');

        $view->render();
    }
}
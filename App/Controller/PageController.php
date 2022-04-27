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

        $view_data = [
            'list_title' => 'Voici les fruits',
            'fruits_list' => [
                'banane',
                'kiwi',
                'fraise',
                'pomme',
            ]
        ];
        
        $toto = AppRepoManager::getRm();


        $view = new View('pages/connexion');

        $view->render($view_data);
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
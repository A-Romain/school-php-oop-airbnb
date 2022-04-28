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
        $view = new View('pages/detailAnnonce');
        $arr = AppRepoManager::getRm()->getRentalsRepository()->detail($id);

        $view_data = [
            'rentals' => $arr,
        ];
        $view->render($view_data);
    }
}
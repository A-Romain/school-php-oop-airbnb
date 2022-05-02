<?php

namespace App\Controller;

use ApertureCore\View;
use App\AppRepoManager;

class AjoutAnnonces
{

    public function ajoutannonces()
    {
     $view_data = [
            'annonce_ajouté' => $this->ajoutannonces(),
     ];
        $view = new View(pages/ajoutAnnonce);
        $view->render($view_data);
    }

    public function bddannonce()
    {
        //TODO:function pour l'ajout d'annonce
    }

}
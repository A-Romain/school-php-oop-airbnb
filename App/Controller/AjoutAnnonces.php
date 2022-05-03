<?php

namespace App\Controller;

use ApertureCore\View;
use App\AppRepoManager;
use App\Model\Rentals;

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

    public function ajout(): void
    {
        $add_annonces = array(
            "owner_id" =>$_POST['owner_id'],
            "type" => $_POST['type'],
            "surface" => $_POST['surface'],
            "description" => $_POST['description'],
            "capacity" => $_POST['capacity'],
            "price" => $_POST['price'],
            "country" => $_POST['country'],
            "city" => $_POST['city'],
            "label" => $_POST['label'],
        );

        $annonces_repository = AppRepoManager::getRm()->getRentalsRepository();

        foreach ($add_annonces as $annonce_name => $annonce_values){
            if (!$add_annonces){
                View::renderError(400);
                return;
            }
        }

        $is_annonces_exists = $annonces_repository->addAnnonces($annonces_repository["owner_id"]);
        if ($is_annonces_exists){
            View::renderError(400);
            return;
        }

        unset($add_annonces["owner_id"]);
        $rentals = $annonces_repository->insert(Rentals::class, $add_annonces);

        if (!$rentals) {
            View::renderError(500);
            return;
        }
    }




}
<?php

namespace App\Controller;

use ApertureCore\View;
use App\AppRepoManager;
use App\Model\Rentals;
use Laminas\Diactoros\Response\RedirectResponse;

class AnnoncesController
{
    /**
     * Route /new-annonce
     * Method : GET
     * Description : Rend la vue ajouter une annonce à l'utilisateur
     */
    public function getAddRentalView(): void
    {
        // Verifie si l'utilisateur est connecte
        if (!isset($_SESSION["user_id"])) {
            View::renderError(401);
            return;
        }

        $view = new View('pages/ajoutAnnonce');
        $view->title = 'Ajout d\'une annonces';

        $view->render();
    }

    /**
     * Route /annonces
     * Method : GET
     * Description : Rend la vue de toutes les annonces à l'utilisateur
     */
    public function getRentalsView()
    {
        // Verifie si l'utilisateur est connecte
        if (!isset($_SESSION["user_id"])) {
            View::renderError(401);
            return;
        }

        if (!isset($_SESSION["user_type"])) {
            $user = AppRepoManager::getRm()->getUsersRepository()->findById($_SESSION["user_id"]);
            $_SESSION["user_type"] = $user->type;
        }

        // Switch qui permet de rediriger selon son type d'utilisateur
        switch ($_SESSION['user_type']){
            case "standard":
                $rentals = AppRepoManager::getRm()->getRentalsRepository()->rentals();
                break;

            case "annonceur":
                $rentals = AppRepoManager::getRm()->getRentalsRepository()->rentalsByUsers($_SESSION['user_id']);
                break;

            default:
                View::renderError(500);
                return;
        }

        $view = new View('pages/listAnnonces');

        $view_data = [
            'rentals' => $rentals,
        ];
        $view->render($view_data);
    }

    /**
     * Route /new-annonce
     * Method : POST
     * Description : Permet d'ajputer une nouvelle annonce par un annonceur
     */
    public function addRental()
    {
        // Verifie si l'utilisateur est connecte
        if (!isset($_SESSION["user_id"])) {
            View::renderError(401);
            return;
        }

        if (!isset($_SESSION["user_type"])) {
            $user = AppRepoManager::getRm()->getUsersRepository()->findById($_SESSION["user_id"]);
            $_SESSION["user_type"] = $user->type;
        }

        // Ne peut pas poster si c'est un standard
        if ($_SESSION["user_type"] !== "annonceur") {
            View::renderError(401);
            return;
        }

        $input_fields = array(
            "type" => $_POST['type'],
            "surface" => $_POST['surface'],
            "capacity" => $_POST['capacity'],
            "country" => $_POST['country'],
            "city" => $_POST['city'],
            "description" => $_POST['description'],
            "equipments" => $_POST['equipments'],
            "price" => $_POST['price'],
        );

        // TODO: log the error with the field name
        // Verifie que les champs sont bien tous presents et rempli
        foreach ($input_fields as $field_name => $field_value){
            if (!$field_value){
                View::renderError(400);
                return;
            }
        }

        // Enregistrer l'annonce

        // 1) Enregistre l'adresse
        $address_id = AppRepoManager::getRm()->getAdressesRepository()->ajoutAdresse($input_fields);

        // 2) Enregistre la rental
        $rental_data = array_merge($input_fields, array(
            "owner_id" => $_SESSION["user_id"],
            "address_id" => $address_id
        ));
        $rental_id = AppRepoManager::getRm()->getRentalsRepository()->insertRental($rental_data);

        // 3) Verifie si equipements present
        if (!$input_fields["equipments"]) {
            // Redirige vers la liste des annonces
            return new RedirectResponse("/annonces");
        }

        // 4) Sauvegarde les equipements
        foreach ($input_fields["equipments"] as $equipment) {
            $equipment_id = AppRepoManager::getRm()->getEquipementRepository()->addEquipment($equipment);
            AppRepoManager::getRm()->getEquipementRepository()->addEquipmentRentalRelation($rental_id, $equipment_id);
        }

        // Redirige vers la liste des annonces
        return new RedirectResponse("/annonces");
    }
}
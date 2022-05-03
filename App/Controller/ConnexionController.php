<?php

namespace App\Controller;

use ApertureCore\View;
use App\App;
use App\AppRepoManager;
use App\Model\Repository\UsersRepository;

class ConnexionController
{
    /**
     * Rend la vue connexion à l'utilisateur
     */
    public function connexion() : void
    {

        $view = new View('pages/connexion');
        $view->title = 'Connexion';

        $view->render();

    }

    /**
     * Rend la vue inscription à l'utilisateur
     */
    public function inscription() : void
    {

        $view = new View('pages/inscription');
        $view->title = 'Inscription';

        $view->render();

    }

    /**
     * Route inscription
     * Method : POST
     * Description : Perment la connexion de l'utilisateur
     */
    public function signIn(): void
    {
        $input_fields_connect = array(
            "email" => $_POST["email"],
            "password" => $_POST["password"],
            "type" => $_POST["type"],
        );

        if (AppRepoManager::getRm()->getUsersRepository()->findUser($_POST['email'], $_POST['password']) === null){
            View::renderError(503);
            return;
        }

        $user = AppRepoManager::getRm()->getUsersRepository()->findUser($_POST['email'], $_POST['password']);
        $_SESSION['user_id'] = $user->id;
        var_dump($_SESSION); die();



        // Enregistrer en session l'utilisateur
    }

    /**
     * Route: /inscription
     * Method: POST
     * Description: Permet l'inscription de l'utilisateur
     */
    public function signUp(): void
    {
        $input_fields = array(
            "email" => $_POST["email"],
            "password" => $_POST["password"],
            "check-password" => $_POST["check-password"],
            "type" => $_POST["type"],
        );

        // TODO: log the error with the field name
        // Verifie que les champs sont bien tous presents et remplis
        foreach ($input_fields as $field_name => $field_value) {
            if (!$field_value) {
                View::renderError(400);
                return;
            }
        }

        // Verifie si l'email est correcte (cf. https://www.php.net/manual/en/function.filter-var.php)
        $is_email_valid = filter_var($input_fields["email"], FILTER_VALIDATE_EMAIL);
        if (!$is_email_valid) {
            View::renderError(400);
            return;
        }

        $user_repository = AppRepoManager::getRm()->getUsersRepository();

        // Verifie si l'utilisateur existe deja
        $is_email_exists = $user_repository->findByEmail($input_fields["email"]);
        if ($is_email_exists) {
            View::renderError(400);
            return;
        }

        // Verifie que password === check-password
        if ($input_fields["password"] !== $input_fields["check-password"]) {
            View::renderError(400);
            return;
        }

        // TODO: check for field in user repository en surchargeant la fonction save
        // Enregistre le nouvel utilisateur
        unset($input_fields["check-password"]); // Retire le check-password de notre tableau
        $user = $user_repository->insert(Users::class, $input_fields);

        // Si non inserted, potentiel erreur du serveur donc
        if (!$user) {
            View::renderError(500);
            return;
        }

        // Enregistrer session (user id)

        // Redirect


        $view = new View('pages/connexion');
        $view->title = 'Connexion';

        $view->render();
    }
}
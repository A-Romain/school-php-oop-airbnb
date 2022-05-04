<?php

namespace App;

use App\Controller\AjoutAnnonces;
use App\Controller\AnnonceController;
use App\Controller\AnnoncesController;
use App\Controller\DetailController;
use App\Controller\ReservationController;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

use ApertureCore\Database\DatabaseConfig;
use ApertureCore\View;
use App\Controller\ResaController;
use App\Controller\ConnexionController;

class App implements DatabaseConfig
{

    private const DB_HOST = 'database';
    private const DB_NAME = 'lamp';
    private const DB_USER = 'lamp';
    private const DB_PASS = 'lamp';

    private static ?self $instance = null;
    public static function startApp(): self
    {
        if(is_null(self::$instance)) self::$instance = new self();

        return self::$instance;
    }

    private Router $router ;

    private function __construct(){
        $this->router =  Router::create();
    }

    #region Interface database functions
    public function getHost(): string
    {
        return self::DB_HOST;
    }

    public function getName(): string
    {
        return self::DB_NAME;
    }

    public function getUser(): string
    {
        return self::DB_USER;
    }

    public function getPass(): string
    {
        return self::DB_PASS;
    }

    #endregion

    public function start() : void
    {
        $this->registerNewRoutes();
        $this->startRouter();

    }

    private function registerNewRoutes() : void
    {
        // (unauthorized)
        $this->router->get('/', [ConnexionController::class, 'getConnexionView']);
//            $this->router->get('/mentions-legales', [ResaController::class,'legalNotice']);

        // Connexion (unauthorized)
        $this->router->any('/connexion', [ConnexionController::class, 'getConnexionView']);
        $this->router->post('/connexion', [ConnexionController::class,'signIn']);
        $this->router->get('/connexion', [ConnexionController::class,'signOut']);

        // Inscription (unauthorized)
        $this->router->get('/inscription', [ConnexionController::class, 'getInscriptionView']);
        $this->router->post('/inscription', [ConnexionController::class,'signUp']);

        // (authorized)
        $this->router->any('/annonces', [AnnoncesController::class, 'getRentalsView']);

        $this->router->get('/new-annonce', [AnnoncesController::class, 'getAddRentalView']);
        $this->router->post('/new-annonce', [AnnoncesController::class, 'addRental']);

        $this->router->any('/reservation',[ReservationController::class, 'formResa']);
        $this->router->any('/detail/{id}', [DetailController::class,'detailRentals']);
    }

    private function startRouter() : void
    {
        try {
            $this->router->dispatch();
        }catch(RouteNotFoundException $e){
            View::renderError(404);
        } catch (InvalidCallableException $e){
            View::renderError(500);
        }
    }

    #region fonction du singleton
    private function __clone(){}
    private function __wakeup(){}
    #endregion

}
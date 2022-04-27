<?php

namespace App;

use App\Controller\AnnonceController;
use App\Controller\AnnoncesController;
use App\Controller\ReservationController;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Router;

use ApertureCore\Database\DatabaseConfig;
use ApertureCore\View;
use App\Controller\PageController;
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
        $this->router->get('/', [PageController::class,'index']);
            $this->router->get('/mentions-legales', [PageController::class,'legalNotice']);
            $this->router->get('/connexion', [ConnexionController::class,'connexion']);
            $this->router->get('/annonce', [AnnoncesController::class,'annonce']);
            $this->router->get('/reservation',[ReservationController::class,'reservation']);

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
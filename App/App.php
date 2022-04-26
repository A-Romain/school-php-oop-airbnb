<?php

namespace App;

use ApertureCore\Database\DatabaseConfig;
use ApertureCore\Http\InvalidRootData;
use ApertureCore\Http\RouteNotFoundException;
use ApertureCore\Http\Router;
use ApertureCore\View;
use App\Controller\PageController;
use App\Controller\ToyController;

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
        $this->router = new Router();
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
        $this->router
            ->registerRoute('get|/', [PageController::class,'index'])
            ->registerRoute('get|/mentions-legales', [PageController::class,'legalNotice'])
            ->registerRoute('get|/toy-list', [ToyController::class,'index']);
    }

    private function startRouter() : void
    {
        try {
            $this->router->start();
        }catch(RouteNotFoundException $e){
            View::renderError(404);
        } catch (InvalidRootData $e){
            View::renderError(500);
        }
    }

    #region fonction du singleton
    private function __clone(){}
    private function __wakeup(){}
    #endregion

}
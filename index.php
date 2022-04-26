<?php

use App\App;

const DS = DIRECTORY_SEPARATOR;
const PATH_ROOT = __DIR__ . DS;


function loadClasses($class)
{

    require_once './' . str_replace('\\', '/', $class) . '.php';
}

spl_autoload_register('loadClasses');

App::startApp()->start();
<?php

use App\App;

session_start();

const DS = DIRECTORY_SEPARATOR;
const PATH_ROOT = __DIR__ . DS;
const STANDARD = 'standard';
const ANNONCEUR = 'annonceur';

require_once PATH_ROOT . 'vendor/autoload.php';

App::startApp()->start();
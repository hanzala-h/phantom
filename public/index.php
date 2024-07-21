<?php

use Phantom\Core\Application;

const BASE_PATH = __DIR__ . '/../';

require_once BASE_PATH . 'vendor/autoload.php';

require_once BASE_PATH . 'Core/Response.php';
require_once BASE_PATH . 'Core/Request.php';
require_once BASE_PATH . 'Core/Router.php';
require_once BASE_PATH . 'Core/Application.php';

$app = new Application();

$app->get('/', function ($req, $res){
    $res->render('index');
});

$app->run();

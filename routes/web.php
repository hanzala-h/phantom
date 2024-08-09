<?php

global $app;

use Phantom\Controllers\SiteController;
use Phantom\Core\Response;

$router = $app->router;

$response = new Response;

$router->get('/', function(){
    return 'Hello World!';
});


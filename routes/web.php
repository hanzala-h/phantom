<?php

global $app;

use Phantom\Controllers\SiteController;

$router = $app->router;

$router->get('/', [SiteController::class, 'index']);


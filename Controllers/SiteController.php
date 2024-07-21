<?php

namespace Phantom\Controllers;

use Phantom\Core\Request;
use Phantom\Core\Response;

class SiteController
{
    public function index(Request $req, Response $res): void
    {
        $res->send('Hi');
    }
}
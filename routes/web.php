<?php

use App\Controllers\HomeController;
use App\Router;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

/*
 * Routes in menu
 */
$routes->add('home', new Route('/', [new HomeController(), 'index']));

$router = new Router();
$router($routes);
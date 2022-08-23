<?php

use App\Controllers\ProductController;
use App\Router;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

/*
 * Api routes
 */
//$routes->add('orders_get', new Route('api/v1/orders', [new OrderController(), 'index'],  [], [], '', [], ['GET']));
$routes->add('product_pricing', new Route('api/v1/products', [new ProductController(), 'index'],  [], [], '', [], ['GET']));

$router = new Router();
$router($routes);
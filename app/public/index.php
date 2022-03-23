<?php
session_start();
$_SESSION['jwt'] = 'secretkey';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, PUT, GET, DELETE, OPTIONS");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// create router
$router = new \Bramus\Router\Router();
$router->setNamespace('Controllers');




// define routes for products
$router->get('/products', 'ProductController@getAll');
$router->get('/products/(\d+)', 'ProductController@getOne');
$router->post('/products', 'ProductController@create');
$router->put('/products/(\d+)', 'ProductController@update');
$router->delete('/products/(\d+)', 'ProductController@delete');

// define routes for categories
$router->get('/categories', 'CategoryController@getAll');

// define routes for stocks
$router->post('/stocks', 'StockController@create');

// define routes for users
$router->post('/users/login', 'UserController@login');




// start router
$router->run();
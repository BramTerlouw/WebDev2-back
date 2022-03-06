<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// create router
$router = new \Bramus\Router\Router();
$router->setNamespace('Controllers');

// define routes
$router->get('/products', 'ProductController@getAll');
$router->get('/products/(\d+)', 'ProductController@getOne');
$router->post('/products', 'ProductController@create');
$router->put('/products/(\d+)', 'ProductController@update');
$router->delete('.products/(\d+)', 'ProductController@delete');

$router->get('/categories', 'CategoryController@getAll');
$router->post('/stocks', 'StockController@create');

// start router
$router->run();
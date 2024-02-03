<?php
require "../vendor/autoload.php";
use Router\router;

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\PaysController@index');
$router->get('/posts/:id', 'App\Controllers\PaysController@show');

$router->run();

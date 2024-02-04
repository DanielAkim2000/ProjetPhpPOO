<?php
use Router\router;
require "../vendor/autoload.php";

define('VIEWS',dirname(__DIR__). DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
define('DB_NAME','KgbDatabase');
define('DB_HOST','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','');

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\PaysController@welcome');
$router->get('/Pays', 'App\Controllers\PaysController@index');
$router->get('/Pays/:id', 'App\Controllers\PaysController@show');


$router->run();

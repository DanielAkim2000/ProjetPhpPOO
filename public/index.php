<?php

use App\Exceptions\NotFoundException;
use Router\router;

require "../vendor/autoload.php";

//Permet d'afficher les erreurs
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('VIEWS',dirname(__DIR__). DIRECTORY_SEPARATOR . 'views'. DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
define('DB_NAME','KgbDatabase');
define('DB_HOST','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','');

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\PaysController@welcome');
$router->get('/Pays', 'App\Controllers\PaysController@index');
$router->get('/Agents', 'App\Controllers\AgentsController@index');
$router->get('/Missions', 'App\Controllers\MissionsController@index');
$router->get('/Planques', 'App\Controllers\PlanquesController@index');
$router->get('/Pays/:id', 'App\Controllers\PaysController@show');
$router->get('/Planques/Edit/:id', 'App\Controllers\PlanquesController@edit');


$router->post('/Planques/Delete/:id', 'App\Controllers\PlanquesController@destroy');
$router->post('/Missions/Delete/:id', 'App\Controllers\PlanquesController@destroy');
$router->post('/Planques/Edit/:id', 'App\Controllers\PlanquesController@update');

try{
    $router->run();
}catch(NotFoundException $e){
    return $e->error404();
};


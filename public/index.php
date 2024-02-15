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
$router->get('/Cibles', 'App\Controllers\CiblesController@index');
$router->get('/Contacts', 'App\Controllers\ContactsController@index');
$router->get('/Specialitys', 'App\Controllers\SpecialityController@index');
$router->get('/Statuts', 'App\Controllers\StatutsController@index');
$router->get('/Typeplanques', 'App\Controllers\TypeplanqueController@index');
$router->get('/Typemissions', 'App\Controllers\TypemissionsController@index');

$router->get('/Pays/:id', 'App\Controllers\PaysController@show');
$router->get('/Planques/Edit/:id', 'App\Controllers\PlanquesController@edit');
$router->get('/Missions/Edit/:id', 'App\Controllers\MissionsController@edit');
$router->get('/Agents/Edit/:id', 'App\Controllers\AgentsController@edit');
$router->get('/Planques/Edit/:id', 'App\Controllers\PlanquesController@edit');
$router->get('/Cibles/Edit/:id', 'App\Controllers\CiblesController@edit');
$router->get('/Contacts/Edit/:id', 'App\Controllers\ContactsController@edit');
$router->get('/Specialitys/Edit/:id', 'App\Controllers\SpecialityController@edit');
$router->get('/Statuts/Edit/:id', 'App\Controllers\StatutsController@edit');
$router->get('/Typeplanques/Edit/:id', 'App\Controllers\TypeplanqueController@edit');
$router->get('/Typemissions/Edit/:id', 'App\Controllers\TypemissionsController@edit');



$router->get('/Agents/Create', 'App\Controllers\AgentsController@create');
$router->get('/Planques/Create', 'App\Controllers\PlanquesController@create');
$router->get('/Cibles/Create', 'App\Controllers\CiblesController@create');
$router->get('/Contacts/Create', 'App\Controllers\ContactsController@create');
$router->get('/Specialitys/Create', 'App\Controllers\SpecialityController@create');
$router->get('/Statuts/Create', 'App\Controllers\StatutsController@create');
$router->get('/Typeplanques/Create', 'App\Controllers\TypeplanqueController@create');
$router->get('/Typemissions/Create', 'App\Controllers\TypemissionsController@create');
$router->get('/Missions/Create', 'App\Controllers\MissionsController@create');


$router->get('/Login', 'App\Controllers\AdministrateurController@login');
$router->get('/Logout', 'App\Controllers\AdministrateurController@logout');


$router->post('/Planques/Delete/:id', 'App\Controllers\PlanquesController@destroy');
$router->post('/Missions/Delete/:id', 'App\Controllers\MissionsController@destroy');
$router->post('/Agents/Delete/:id', 'App\Controllers\AgentsController@destroy');
$router->post('/Cibles/Delete/:id', 'App\Controllers\CiblesController@destroy');
$router->post('/Contacts/Delete/:id', 'App\Controllers\ContactsController@destroy');
$router->post('/Specialitys/Delete/:id', 'App\Controllers\SpecialityController@destroy');
$router->post('/Statuts/Delete/:id', 'App\Controllers\StatutsController@destroy');
$router->post('/Typeplanques/Delete/:id', 'App\Controllers\TypeplanqueController@destroy');
$router->post('/Typemissions/Delete/:id', 'App\Controllers\TypemissionsController@destroy');




$router->post('/Planques/Edit/:id', 'App\Controllers\PlanquesController@update');
$router->post('/Missions/Edit/:id', 'App\Controllers\MissionsController@update');
$router->post('/Agents/Edit/:id', 'App\Controllers\AgentsController@update');
$router->post('/Cibles/Edit/:id', 'App\Controllers\CiblesController@update');
$router->post('/Contacts/Edit/:id', 'App\Controllers\ContactsController@update');
$router->post('/Specialitys/Edit/:id', 'App\Controllers\SpecialityController@update');
$router->post('/Statuts/Edit:id', 'App\Controlllers\StatutsController@update');
$router->post('/Typeplanques/Edit/:id', 'App\Controllers\TypeplanqueController@update');
$router->post('/Typemissions/Edit/:id', 'App\Controllers\TypemissionsController@update');


$router->post('/Agents/Create', 'App\Controllers\AgentsController@created');
$router->post('/Planques/Create', 'App\Controllers\PlanquesController@created');
$router->post('/Cibles/Create', 'App\Controllers\CiblesController@created');
$router->post('/Contacts/Create', 'App\Controllers\ContactsController@created');
$router->post('/Specialitys/Create', 'App\Controllers\SpecialityController@created');
$router->post('/Statuts/Create', 'App\Controllers\StatutsController@created');
$router->post('/Typeplanques/Create', 'App\Controllers\TypeplanqueController@created');
$router->post('/Typemissions/Create', 'App\Controllers\TypemissionsController@created');
$router->post('/Missions/Create', 'App\Controllers\MissionsController@created');



$router->post('/Login', 'App\Controllers\AdministrateurController@loginPosted');



try{
    $router->run();
}catch(NotFoundException $e){
    return $e->error404();
};


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

$router->get('/','App\Controllers\MissionsController@welcome');

$router->get('/Agents/Create', 'App\Controllers\AgentsController@create');
$router->get('/Planques/Create', 'App\Controllers\PlanquesController@create');
$router->get('/Cibles/Create', 'App\Controllers\CiblesController@create');
$router->get('/Contacts/Create', 'App\Controllers\ContactsController@create');
$router->get('/Specialitys/Create', 'App\Controllers\SpecialityController@create');
$router->get('/Statuts/Create', 'App\Controllers\StatutsController@create');
$router->get('/Typeplanques/Create', 'App\Controllers\TypeplanqueController@create');
$router->get('/Typemissions/Create', 'App\Controllers\TypemissionsController@create');
$router->get('/Missions/Create', 'App\Controllers\MissionsController@create');
$router->get('/Admin/Create', 'App\Controllers\AdministrateurController@create');

$router->get('/Agents/Filtre/:id', 'App\Controllers\AgentsController@filtre');
$router->get('/Missions/Filtre/:id', 'App\Controllers\MissionsController@filtre');
$router->get('/Cibles/Filtre/:id', 'App\Controllers\CiblesController@filtre');
$router->get('/Contacts/Filtre/:id', 'App\Controllers\ContactsController@filtre');
$router->get('/Planques/Filtre/:id', 'App\Controllers\PlanquesController@filtre');

$router->get('/Agents/:page', 'App\Controllers\AgentsController@index');
$router->get('/Missions/:page', 'App\Controllers\MissionsController@index');
$router->get('/Planques/:page', 'App\Controllers\PlanquesController@index');
$router->get('/Cibles/:page', 'App\Controllers\CiblesController@index');
$router->get('/Contacts/:page', 'App\Controllers\ContactsController@index');
$router->get('/Specialitys/:page', 'App\Controllers\SpecialityController@index');
$router->get('/Statuts/:page', 'App\Controllers\StatutsController@index');
$router->get('/Typeplanques/:page', 'App\Controllers\TypeplanqueController@index');
$router->get('/Typemissions/:page', 'App\Controllers\TypemissionsController@index');
$router->get('/Admin/:page', 'App\Controllers\AdministrateurController@index');

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
$router->get('/Admin/Edit/:id', 'App\Controllers\AdministrateurController@edit');


$router->get('/Login', 'App\Controllers\AdministrateurController@login');
$router->get('/Logout', 'App\Controllers\AdministrateurController@logout');


$router->post('/Planques/Delete/:id/:token', 'App\Controllers\PlanquesController@destroy');
$router->post('/Missions/Delete/:id/:token', 'App\Controllers\MissionsController@destroy');
$router->post('/Agents/Delete/:id/:token', 'App\Controllers\AgentsController@destroy');
$router->post('/Cibles/Delete/:id/:token', 'App\Controllers\CiblesController@destroy');
$router->post('/Contacts/Delete/:id/:token', 'App\Controllers\ContactsController@destroy');
$router->post('/Specialitys/Delete/:id/:token', 'App\Controllers\SpecialityController@destroy');
$router->post('/Statuts/Delete/:id/:token', 'App\Controllers\StatutsController@destroy');
$router->post('/Typeplanques/Delete/:id/:token', 'App\Controllers\TypeplanqueController@destroy');
$router->post('/Typemissions/Delete/:id/:token', 'App\Controllers\TypemissionsController@destroy');
$router->post('/Admin/Delete/:id/:token', 'App\Controllers\AdministrateurController@destroy');



$router->post('/Planques/Edit/:id/:token', 'App\Controllers\PlanquesController@update');
$router->post('/Missions/Edit/:id/:token', 'App\Controllers\MissionsController@update');
$router->post('/Agents/Edit/:id/:token', 'App\Controllers\AgentsController@update');
$router->post('/Cibles/Edit/:id/:token', 'App\Controllers\CiblesController@update');
$router->post('/Contacts/Edit/:id/:token', 'App\Controllers\ContactsController@update');
$router->post('/Specialitys/Edit/:id/:token', 'App\Controllers\SpecialityController@update');
$router->post('/Statuts/Edit:id/:token', 'App\Controlllers\StatutsController@update');
$router->post('/Typeplanques/Edit/:id/:token', 'App\Controllers\TypeplanqueController@update');
$router->post('/Typemissions/Edit/:id/:token', 'App\Controllers\TypemissionsController@update');
$router->post('/Admin/Edit/:id/:token', 'App\Controllers\AdministrateurController@update');


$router->post('/Agents/Create/:token', 'App\Controllers\AgentsController@created');
$router->post('/Planques/Create/:token', 'App\Controllers\PlanquesController@created');
$router->post('/Cibles/Create/:token', 'App\Controllers\CiblesController@created');
$router->post('/Contacts/Create/:token', 'App\Controllers\ContactsController@created');
$router->post('/Specialitys/Create/:token', 'App\Controllers\SpecialityController@created');
$router->post('/Statuts/Create/:token', 'App\Controllers\StatutsController@created');
$router->post('/Typeplanques/Create/:token', 'App\Controllers\TypeplanqueController@created');
$router->post('/Typemissions/Create/:token', 'App\Controllers\TypemissionsController@created');
$router->post('/Missions/Create/:token', 'App\Controllers\MissionsController@created');
$router->post('/Admin/Create/:token', 'App\Controllers\AdministrateurController@created');

$router->post('/Missions/Recherche', 'App\Controllers\MissionsController@recherche');
$router->post('/Agents/Recherche', 'App\Controllers\AgentsController@recherche');
$router->post('/Cibles/Recherche', 'App\Controllers\CiblesController@recherche');
$router->post('/Contacts/Recherche', 'App\Controllers\ContactsController@recherche');
$router->post('/Planques/Recherche', 'App\Controllers\PlanquesController@recherche');

$router->get('/Missions/Show/:id', 'App\Controllers\MissionsController@show');

$router->post('/Recherche', 'App\Controllers\MissionsController@recherchePublic');


$router->post('/Login', 'App\Controllers\AdministrateurController@loginPosted');

$router->get('/:page','App\Controllers\MissionsController@welcome');



try{
    $router->run();
}catch(NotFoundException $e){
    return $e->error404();
};


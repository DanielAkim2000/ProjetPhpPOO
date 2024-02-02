<?php
require "../vendor/autoload.php";
use Router\router;

$router = new Router($_GET['url']);
$router->show();

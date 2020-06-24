<?php
require '../vendor/autoload.php';
require '../base/config.php';

$route = new \Base\Route();
// закладываем статические/по-умолчанию/преднастроенные пути
$route->add('/', \App\Controller\Login::class);
$route->add('/register', \App\Controller\Register::class);


$app = new \Base\Application($route);
$app->run();
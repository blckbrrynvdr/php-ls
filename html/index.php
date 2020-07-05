<?php
require '../vendor/autoload.php';
require '../base/config.php';
require '../base/InitDb.php';

$route = new \Base\Route();
// закладываем статические/по-умолчанию/преднастроенные пути
$route->add('/', \App\Controller\Login::class);
$route->add('/register', \App\Controller\Register::class);
$route->add('/users', \App\Controller\Admin::class, 'users');
$route->add('/admin', \App\Controller\Admin::class, 'users');


$app = new \Base\Application($route);
$app->run();

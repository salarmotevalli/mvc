<?php

require_once __DIR__. '/../vendor/autoload.php';
use App\core\Application;

$app= new Application(dirname(__DIR__));

$app->router->get('/', [\App\controllers\SiteController::class, 'home']);
$app->router->get('/hello', [\App\controllers\SiteController::class, 'hello']);
$app->router->post                                                    ('/posthandel', [\App\controllers\SiteController::class, 'handleContent']);

$app->run();
<?php

use App\core\Application;

function setter (Application $app): void
{
    $app->router->get('/', [\App\controllers\SiteController::class, 'home']);
    $app->router->get('/hello', [\App\controllers\SiteController::class, 'hello']);

    $app->router->get('/login', [\App\controllers\AuthController::class, 'login']);
    $app->router->post('/login', [\App\controllers\AuthController::class, 'login']);
    $app->router->get('/register', [\App\controllers\AuthController::class, 'register']);
    $app->router->post('/register', [\App\controllers\AuthController::class, 'register']);
}
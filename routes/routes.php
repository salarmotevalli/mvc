<?php declare(strict_types=1);

use App\controllers\GraphqlController;
use App\controllers\SiteController;
use App\core\Application;

function set_routes(Application $app): void
{
    $app->router->get('/', [SiteController::class, 'home']);
    $app->router->get('/hello', [SiteController::class, 'hello']);

    /** the both of below routs are the graphql routes*/
    $app->router->get('/graphql', [GraphqlController::class, 'index']);
    $app->router->post('/graphql', [GraphqlController::class, 'index']);
}

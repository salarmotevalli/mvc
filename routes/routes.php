<?php declare(strict_types=1);

use App\controllers\GraphqlController;
use App\core\Application;

function setter(Application $app): void
{
    $app->router->get('/', [\App\controllers\SiteController::class, 'home']);
    $app->router->get('/hello', [\App\controllers\SiteController::class, 'hello']);

    /** the both of below routs are the graphql routes*/
    $app->router->get('/graphql', [GraphqlController::class, 'index']);
    $app->router->post('/graphql', [GraphqlController::class, 'index']);
}

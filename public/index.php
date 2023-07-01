<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/routes.php';

$app = new \App\core\Application(__DIR__ . '/..');

set_routes($app);

// $server = IoServer::factory(
//     new HttpServer(
//        new WsServer(
//            new Chat(),
//        ),
//    ),
//     8081
// );

// $server->run();

$app->run();
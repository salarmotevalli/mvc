<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
 use App\websocket\Chat;
 use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

$app = new \App\core\Application(__DIR__);

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
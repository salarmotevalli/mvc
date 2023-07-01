<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/routes.php';

$app = new \App\core\Application(__DIR__ . '/..');

set_routes($app);

$app->run();
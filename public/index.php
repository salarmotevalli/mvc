<?php

require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../routes/routes.php';
use App\core\Application;

$app= new Application(dirname(__DIR__));
setter($app);
$app->run();
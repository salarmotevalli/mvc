<?php

namespace App\controllers;

use App\core\Application;

class SiteController
{

    public  function handleContent()
    {
        return 'i could handele it from controller';
    }

    public function home()
    {
        return Application::$app->router->renderView('home');
    }

    public function hello()
    {
        return Application::$app->router->renderView('hello');
    }

}
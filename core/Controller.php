<?php

namespace App\core;

class Controller
{
    public $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function view($view)
    {
        return Application::$app->router->renderView($view);
    }
}
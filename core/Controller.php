<?php

namespace App\core;

class Controller
{
    public $request;
    public string $layout= 'main';

    public function __construct()
    {
        $this->request = new Request();
    }

    public function view($view)
    {
        return Application::$app->router->renderView($view);
    }

    public function setLayout($layout)
    {
        $this->layout= $layout;
    }
}
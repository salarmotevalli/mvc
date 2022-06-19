<?php

namespace App\core;

class Controller
{
    public string $layout= 'main';

    public function view($view): bool|array|string
    {
        return Application::$app->router->view->renderView($view);
    }

    public function setLayout($layout): void
    {
        $this->layout= $layout;
    }
}
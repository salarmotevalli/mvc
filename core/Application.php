<?php

namespace App\core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Response $response;
    public Request $request;
    public $controller;
    public static Application $app;

    public function __construct($path)
    {
        self::$ROOT_DIR = $path;
        $this->request= new Request();
        $this->response= new Response();
        $this->router= new Router();
        self::$app= $this;
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }

    /** @return Controller */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /** @param Controller $controller */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}

<?php

namespace App\core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Response $response;
    public Request $request;
    public static Application $app;

    public function __construct($path)
    {
        self::$ROOT_DIR = $path;
        $this->request= new Request();
        $this->response= new Response();
        $this->router= new Router($this->request, $this->response);
        self::$app= $this;
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}

<?php

namespace App\core;

use App\core\Rendering\View\View;

class Router
{

    public Response $response;
    public Request $request;
    public View $view;

    public function __construct()
    {
        $this->request= new Request();
        $this->response= new Response();
        $this->view= new View();
    }

    protected array $routes= [];

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function get($uri, $callback): void
    {
        $this->routes['GET'][$uri]= $callback;
    }

    public function post($url, $callback): void
    {
        $this->routes['POST'][$url]= $callback;
    }

    public function resolve()
    {
        $path= $this->request->getPath();
        $method= $this->request->method();
        $callback= $this->routes[$method][$path];
        if ($callback === null)
        {
            $this->response->setStatusCode(484);
            return $this->view->onlyView('_404');
        }

        if (is_string($callback))
        {
            return $this->view->renderView($callback);
        }

        if (is_array($callback))
        {
            Application::$app->controller= new $callback[0];
            $callback[0]= Application::$app->controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

}

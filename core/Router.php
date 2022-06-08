<?php

namespace App\core;

class Router
{

    public Response $response;
    public Request $request;

    public function __construct(Request $request, Response $response)
    {
        $this->request= new Request();
        $this->response= new Response();
    }

    protected array $routes= [];

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
            return $this->renderView('_404');
        }

        if (is_string($callback))
        {
            return $this->renderView($callback);
        }

        if (is_array($callback))
        {
            Application::$app->controller= new $callback[0];
            $callback[0]= Application::$app->controller;
        }
        return call_user_func($callback);
    }

    public function renderView(string $view): array|bool|string
    {
        return str_replace('{{content}}', $this->onlyView($view), $this->layOutContent());
    }

    private function layOutContent(): bool|string
    {
        $layout= Application::$app->controller->layout;
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layout/{$layout}.php";
        return ob_get_clean();
    }

    private function onlyView($view): bool|string
    {
        ob_start();
        require_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

}

<?php declare(strict_types=1);

namespace App\core;

use App\core\Rendering\View\View;

class Router
{
    public Response $response;

    public Request $request;

    public View $view;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
    }

    protected array $routes = [];

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param $uri
     * @param $callback
     * @return void
     */
    public function get($uri, $callback): void
    {
        $this->routes['GET'][$uri] = $callback;
    }

    /**
     * @param $url
     * @param $callback
     * @return void
     */
    public function post($url, $callback): void
    {
        $this->routes['POST'][$url] = $callback;
    }

    public function resolve()
    {
        // Get callback by path and request method
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path];

        switch (true) {
            // Return not found page
            case $callback === null:
                $this->response->setStatusCode(404);
                return $this->view->onlyView('_404');
            // Return given view
            case is_string($callback):
                return $this->view->renderView($callback);

            // Execute controller and return result
            case is_array($callback):
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;
                return call_user_func($callback, $this->request, $this->response);

        }

    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}

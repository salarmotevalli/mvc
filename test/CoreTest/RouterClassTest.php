<?php

namespace Test;

use App\core\Request;
use App\core\Response;
use App\core\Router;
use PHPUnit\Framework\TestCase;


class RouterClassTest extends TestCase
{
    public function test_router_class_variable()
    {
        $this->assertClassHasAttribute('response', Router::class);
        $this->assertClassHasAttribute('request', Router::class);
        $this->assertClassHasAttribute('routes', Router::class);

        $router = new Router;

        $this->assertTrue($router->response instanceof Response);
        $this->assertTrue($router->request instanceof Request);
    }

    public function test_existing_router_class_method()
    {
        $methods= ['post','resolve','renderView','layOutContent','onlyView','getResponse'];

        foreach ($methods as $method) {
            $this->assertTrue(method_exists(Router::class, $method));
        }
    }

    public function test_performance_of_Router_class_method()
    {
        $router= new Router;
                $router->get('/test_get', [\App\core\Controller::class, 'setLayout']);
                $router->post('/test_post', [\App\core\Controller::class, 'setLayout']);
                $this->assertArrayHasKey('/test_get', $router->getRoutes()['GET']);
                $this->assertArrayHasKey('/test_post', $router->getRoutes()['POST']);
                $this->assertContains([\App\core\Controller::class, 'setLayout'], $router->getRoutes()['POST']);
                $this->assertContains([\App\core\Controller::class, 'setLayout'], $router->getRoutes()['GET']);
                
    }
}

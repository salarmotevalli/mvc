<?php declare(strict_types=1);

namespace App\test\CoreTest;

use App\core\Request;
use App\core\Response;
use App\core\Router;
use PHPUnit\Framework\TestCase;

class RouterClassTest extends TestCase
{
    public function testRouterClassVariable()
    {
        $this->assertClassHasAttribute('response', Router::class);
        $this->assertClassHasAttribute('request', Router::class);
        $this->assertClassHasAttribute('routes', Router::class);

        $router = new Router();

        $this->assertTrue($router->response instanceof Response);
        $this->assertTrue($router->request instanceof Request);
    }

    public function testExistingRouterClassMethod()
    {
        $methods = ['post', 'resolve', 'getResponse'];

        foreach ($methods as $method) {
            $this->assertTrue(method_exists(Router::class, $method));
        }
    }

    public function testPerformanceOfRouterClassMethod()
    {
        $router = new Router();
        $router->get('/test_get', [\App\core\Controller::class, 'setLayout']);
        $router->post('/test_post', [\App\core\Controller::class, 'setLayout']);
        $this->assertArrayHasKey('/test_get', $router->getRoutes()['GET']);
        $this->assertArrayHasKey('/test_post', $router->getRoutes()['POST']);
        $this->assertContains([\App\core\Controller::class, 'setLayout'], $router->getRoutes()['POST']);
        $this->assertContains([\App\core\Controller::class, 'setLayout'], $router->getRoutes()['GET']);
    }
}

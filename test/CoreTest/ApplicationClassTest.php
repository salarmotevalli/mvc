<?php declare(strict_types=1);

namespace App\test\CoreTest;

use App\core\Application;
use App\core\Controller;
use App\core\Request;
use App\core\Response;
use App\core\Router;
use PHPUnit\Framework\TestCase;

class ApplicationClassTest extends TestCase
{
    public function testAppllicationClassVariable()
    {
        $app = new Application(dirname(__DIR__));
        $this->assertClassHasStaticAttribute('ROOT_DIR', Application::class);
        $this->assertClassHasStaticAttribute('app', Application::class);
        $this->assertClassHasAttribute('router', Application::class);
        $this->assertClassHasAttribute('response', Application::class);
        $this->assertClassHasAttribute('request', Application::class);
        $this->assertClassHasAttribute('controller', Application::class);

        $app->controller = new Controller();
        $this->assertTrue($app->router instanceof Router);
        $this->assertIsString($app::$ROOT_DIR);
        $this->assertTrue($app->response instanceof Response);
        $this->assertTrue($app->request instanceof Request);
        $this->assertTrue($app->controller instanceof Controller);
        $this->assertTrue($app::$app instanceof Application);
    }

    public function testAppllicationClassMethod()
    {
        $this->assertTrue(method_exists(Application::class, 'run'));
        $this->assertTrue(method_exists(Application::class, 'getController'));
        $this->assertTrue(method_exists(Application::class, 'setController'));

        $app = new Application(dirname(__DIR__));

        $controller = new Controller();
        $app->setController($controller);
        $this->assertEquals($app->getController(), $controller);
    }
}

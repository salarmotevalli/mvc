<?php declare(strict_types=1);

namespace App\test\CoreTest;

use App\core\Controller;
use PHPUnit\Framework\TestCase;

class ControllerClassTest extends TestCase
{
    public function testControllerClassVariable()
    {
        $controller = new Controller();
        $this->assertClassHasAttribute('layout', Controller::class);
        $this->assertEquals($controller->layout, 'main');
    }

    public function testControllerClassMethod()
    {
        $controller = new Controller();
        $this->assertTrue(method_exists(Controller::class, 'view'));
        $this->assertTrue(method_exists(Controller::class, 'setLayout'));
        $controller->setLayout('auth');
        $this->assertEquals($controller->layout, 'auth');
    }
}

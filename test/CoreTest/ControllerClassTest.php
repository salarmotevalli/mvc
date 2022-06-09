<?php

namespace Test;

use App\core\Controller;
use App\core\Request;
use PHPUnit\Framework\TestCase;


class ControllerClassTest extends TestCase
{
    public function test_controller_class_variable()
    {
        $controller= new Controller;
       $this->assertClassHasAttribute('request', Controller::class);
       $this->assertTrue($controller->request instanceof Request);
       $this->assertClassHasAttribute('layout', Controller::class);
       $this->assertEquals($controller->layout, 'main');
    }   

    public function test_controller_class_method()
    {
        $controller= new Controller;
        $this->assertTrue(method_exists(Controller::class, 'view'));
        $this->assertTrue(method_exists(Controller::class, 'setLayout'));
        $controller->setLayout('auth');
        $this->assertEquals($controller->layout, 'auth');

    }
}

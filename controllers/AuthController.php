<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;

class AuthController extends Controller
{
    public function login()
    {
        if ($this->request->isPost()) {
            return 'hello from post';
        }
        $this->setLayout('auth');
        return $this->view('login');
    }

    public function register()
    {
        if ($this->request->isPost()) {
            return 'hello from post';
        }

        return $this->view('register');
    }
}
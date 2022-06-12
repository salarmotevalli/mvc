<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            return $request->getBody();
        }
        $this->setLayout('auth');
        return $this->view('login');
    }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return $request->getBody();
        }
        
        $this->setLayout('auth');
        return $this->view('register');
    }
}
<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;

class SiteController extends Controller
{

    public function handleContent()
    {
        return 'i could handele it from controller';
    }

    public function home()
    {
        return $this->view('home');
    }

    public function hello()
    {
        return $this->view('hello');
    }

}
<?php

namespace App\controllers;

use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\core\Controller;
use App\core\Db\Connection;

class SiteController extends Controller
{

    public function home()
    {
        Connection::connect();
        $user= User::find(1);
        var_dump($user);
    }

    public function hello()
    {
        return $this->view('hello');
    }

}
<?php declare(strict_types=1);

namespace App\controllers;

use App\core\Controller;
use App\core\Db\Connection;
use App\models\User;

class SiteController extends Controller
{
    public function home()
    {
        Connection::connect();
        $user = User::find(1);
        var_dump($user);
    }

    public function hello()
    {
        return $this->view('hello');
    }
}

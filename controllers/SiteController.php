<?php declare(strict_types=1);

namespace App\controllers;

use App\core\Controller;
use App\core\Db\Connection;
use App\models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class SiteController extends Controller
{
    public function home()
    {
        Connection::connect();
        $user = User::all();
        return $user;
    }

    public function hello()
    {
        return $this->view('hello');
    }
}

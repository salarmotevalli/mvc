<?php declare(strict_types=1);

namespace App\core\Db;

use App\core\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    public static function connect()
    {
        $capsule = new Capsule();
        $capsule->addConnection(Config::getValue('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

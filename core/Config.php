<?php declare(strict_types=1);

namespace App\core;

class Config
{
    private static ?Config $instance = null;

    private static $values = null;

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    private function __construct()
    {
        $config = require_once Application::$ROOT_DIR . '/config/config.php';
        self::$values = $config;
    }

    public static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getValue($key)
    {
        self::init();

        return self::$values[$key] ?? '';
    }
}

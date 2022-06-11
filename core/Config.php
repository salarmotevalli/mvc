<?php

namespace App\core;

class Config
{
    private static $instance= null;
    private static $values= null;

    private function __clone() {}
    private function __wakeup() {}
    private function __construct()
    {
        $config['db'] = 'test1';   
        $config['hostname'] = 'test2';   
        $config['port'] = '3036';   
        $config['username'] = 'salarmotevalli'; 
        
        self::$values= $config;
    }

    public static function getValue($key)
    {
        self::init();
        return self::$values[$key] ?? '';
    }

    public static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
<?php

namespace App\core;

class Request
{

    public function test()
    {
        echo 'hello';
    }
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $positin = strpos($path, '?');
        if ($positin === false){
            return $path;
        }
        return substr($path, 0, $positin);
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}

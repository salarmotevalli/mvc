<?php

namespace App\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $positin = strpos($path, '?');
        if ($positin === false) {
            return $path;
        }
        return substr($path, 0, $positin);
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }
}

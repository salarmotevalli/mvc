<?php declare(strict_types=1);

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
        return $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'POST';
    }

    public function getBody()
    {
        if ($this->method() == 'POST') {
            return $_POST;
        }

        return $_GET;
    }
}

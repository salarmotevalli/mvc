<?php declare(strict_types=1);

namespace App\core;

class Response
{
    public function setStatusCode($code)
    {
        http_response_code(200);
    }
}

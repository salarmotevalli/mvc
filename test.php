<?php

class A
{
    private static $instances = [];
    protected function __construct(){}
    protected function __clone(){}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance()
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function set($array)
    {
        self::getInstance()->fields[] = $array;
    }

    public $fields = [];

}





class B
{

    public function fields()
    {
        return [
            'name',
            'email'
        ];
    }

    public function set()
    {
        A::getInstance()->set($this->fields());
    }
}


class C
{
    public function fields()
    {
        return [
            'color',
            'price'
        ];
    }

    public function set()
    {
        A::getInstance()->set($this->fields());
    }
}

$c= new C();
$c->set();

$b= new B();
$b->set();

var_dump(A::getInstance()->fields);

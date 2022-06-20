<?php

namespace App\core\Rendering\Graphql;


class Mutation
{ 
    private static array $instances = [];
    protected function __construct(){
        $this->rootQury = new ObjectType([
            'name' => 'Query',
            'fields' => $this->fields,
        ]);
    }
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

    public array $fields = [];


    public $rootQury;

    public function getRootQuery()
    {
        return $this->rootQury;
    }
}

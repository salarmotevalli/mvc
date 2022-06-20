<?php

namespace App\core\Rendering\Graphql;

use GraphQL\Type\Definition\ObjectType;

class Mutation
{
    private static array $instances = [];
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

    public array $fields = [];

    public function getRoot()
    {
        return new ObjectType([
            'name' => 'Mutation',
            'fields' => $this->fields,
        ]);           }
}

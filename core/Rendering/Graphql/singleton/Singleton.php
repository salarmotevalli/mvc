<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql\singleton;

use GraphQL\Type\Definition\ObjectType;

abstract class Singleton implements SingletonInterface
{
    private static array $instances = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    public static function getInstance(): self
    {
        $cls = static::class;

        if (! isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function setField($field): void
    {
        self::getInstance()->fields = array_merge($field, self::getInstance()->fields);
    }

    public array $fields = [];

    public function getRoot(): ObjectType|null
    {
        if (empty($this->fields)) {
            return null;
        }

        return new ObjectType([
            'name' => $this->getName(),
            'fields' => $this->fields,
        ]);
    }

    public function getName(): string
    {
        $namespaceArray = explode('\\', get_called_class());

        return array_pop($namespaceArray);
    }
}

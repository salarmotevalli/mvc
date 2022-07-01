<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql\singleton;

use GraphQL\Type\Definition\ObjectType;

interface SingletonInterface
{
    public static function getInstance(): self;

    public function setField($field): void;

    public function getRoot(): ObjectType|null;
}

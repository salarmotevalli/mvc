<?php

namespace App\core\Rendering\Graphql\singleton;

use GraphQL\Type\Definition\ObjectType;

interface SingletonInterface
{
    public static function getInstance(): self;

    public function setField($field): void;

    public function getRoot(): ObjectType|null;
}
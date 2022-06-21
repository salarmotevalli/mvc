<?php

namespace App\core\Rendering\Graphql\implementation;

use GraphQL\Type\Definition\ObjectType;

interface GraphModelInterface
{
    public static function getModelType(): ObjectType;
}
<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql\implementation;

use GraphQL\Type\Definition\ObjectType;

interface GraphModelInterface
{
    public static function getModelType(): ObjectType;

    public static function makeModelType(): void;
}

<?php

namespace App\Graph;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType implements \App\core\Rendering\Graphql\implementation\GraphModelInterface
{

    public static function getModelType(): ObjectType
    {
        return new ObjectType([
            'name' => 'user',
            'description' => 'A user',
            'fields' => [
                    'id' => Type::id(),
                    'name' => Type::string(),
                    'email' => Type::string(),
                    'created_at' => Type::string(),
                    'updated_at' => Type::string(),

                ],
        ]);
    }
}
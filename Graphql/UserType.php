<?php

namespace App\Graphql;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class UserType implements \App\core\Rendering\Graphql\implementation\GraphModelInterface
{
    public static function makeModelType(): void
    {
        self::$modelType= new ObjectType([
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

    public static function getModelType(): ObjectType
    {
        if (self::$modelType == null){
            self::makeModelType();
        }
        return self::$modelType; 
    }

    public static $modelType= null;

}
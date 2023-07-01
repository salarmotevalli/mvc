<?php declare(strict_types=1);

namespace App\Graphql;

use App\core\Rendering\Graphql\implementation\GraphModelInterface;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CompanyType implements GraphModelInterface
{
    public static function makeModelType(): void
    {
        self::$modelType = new ObjectType([
            'name' => 'company',
            'description' => 'A Company',
            'fields' => [
                'id' => Type::id(),
                'name' => Type::string(),
                'user_id' => Type::int(),
                'created_at' => Type::string(),
                'description' => Type::string(),
            ],
        ]);
    }

    public static function getModelType(): ObjectType
    {
        if (self::$modelType == null) {
            self::makeModelType();
        }

        return self::$modelType;
    }

    public static $modelType = null;
}

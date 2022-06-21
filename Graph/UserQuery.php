<?php

namespace App\Graph;

use App\core\Rendering\Graphql\Query;
use App\Models\User;
use GraphQL\Type\Definition\Type;

class UserQuery extends \App\core\Rendering\Graphql\implementation\GraphTypes
{

    public function fields(): array
    {
        return [
            'name' => 'Query',
            'fields' => [
                'user' => [
                    'type' => UserType::getModelType(),
                    'args' => [
                        'id' => ['type' => Type::id()],
                    ],
                    'resolve' => function ($root, $args) {
                        return User::find($args['id'])->toArray();
                    },
                ],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return Query::class;
    }
}
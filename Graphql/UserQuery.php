<?php declare(strict_types=1);

namespace App\Graphql;

use App\core\Rendering\Graphql\Query;
use App\Models\User;
use GraphQL\Type\Definition\Type;

class UserQuery extends \App\core\Rendering\Graphql\implementation\GraphTypes
{
    /**
     * return field of your query in the bewlow method.
     *
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'user' => [
                'type' => UserType::getModelType(),
                'args' => [
                    'id' => Type::id(),
                ],
                'resolve' => function ($root, $args) {
                    return User::find($args['id'])->toArray();
                },
            ],
            'users' => [
                'type' => Type::listOf(UserType::getModelType()),
                'resolve' => function ($root, $args) {
                    return User::all()->toArray();
                },
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Query::class;
    }
}

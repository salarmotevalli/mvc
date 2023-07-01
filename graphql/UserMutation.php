<?php declare(strict_types=1);

namespace App\graphql;

use App\core\Rendering\Graphql\implementation\GraphTypes;
use App\core\Rendering\Graphql\Mutation;
use App\Models\User;
use GraphQL\Type\Definition\Type;

class UserMutation extends GraphTypes
{
    /**
     * return field of your query in the bewlow method.
     *
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'addUser' => [
                'type' => UserType::getModelType(),
                'description' => 'Add a new user',
                'args' => [
                    'username' => Type::string(),
                    'email' => Type::string(),
                    'password' => Type::string(),
                ],
                'resolve' => function ($root, $args) {
                    $user = new User();
                    $user->username = $args['username'];
                    $user->email = $args['email'];
                    $user->password = $args['password'];
                    $user->save();

                    return $user->toArray();
                },
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return Mutation::class;
    }
}

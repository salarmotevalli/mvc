<?php

namespace App\Graphql;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use App\core\Rendering\Graphql\implementation\GraphTypes;
use App\core\Rendering\Graphql\Mutation;

class UserMutation extends GraphTypes
{
    /**
     * return field of your query in the bewlow method
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'addUser' => [
                'type' => UserType::getModelType(),
                'description' => 'Add a new user',
                'args' => [
                    'name' => Type::string(),
                    'email' => Type::string(),
                    'password' => Type::string(),
                ],
                'resolve' => function ($root, $args) {
                    $user= new User();
                    $user->name= $args['name'];
                    $user->email= $args['email'];
                    $user->password= $args['password'];
                    $user->save();
                    return $user->toArray();
                },
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return Mutation::class;
    }
}

<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

$rootQuery = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'user' => [
            'type' => $userType,
            'args' => [
                'id' => ['type' => Type::id()],
            ],
            'resolve' => function ($root, $args) {
                return User::find($args['id'])->toArray();
            },
        ],
    ],
]);        A::getInstance()->set($this->fields());

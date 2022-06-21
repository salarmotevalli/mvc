<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;

$userMutations= [
    'addUser' => [
        'type' => $userType,
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
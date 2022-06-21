<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

$userType = new ObjectType([
    'name' => 'user',
    'description' => 'A user',
    'fields' => function() use (&$companyType) {
        return [
            'id' => ['type' => Type::id()],
            'name' => ['type' => Type::string()],
            'email' => ['type' => Type::string()],
            'created_at' => ['type' => Type::string()],
            'updated_at' => ['type' => Type::string()],
            'companies' => [
                'type' => Type::listOf($companyType),
                'resolve' => function ($root, $args) {
                    $user= User::where('id', $root['id'])->with(['companies'])->first();
                    return $user->companies->toArray();
                },
            ]
        ];
    },
]);






$companyType = new ObjectType([
    'name' => 'Company',
    'description' => 'A company',
    'fields' => [
        'id' =>  Type::id(),
        'name' =>  Type::string(),
        'description' =>  Type::string(),
        'user_id' =>  Type::id(),
        'created_at' =>  Type::string(),
        'updated_at' =>  Type::string(),
    ],
]);



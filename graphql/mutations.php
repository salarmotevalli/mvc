<?php

use GraphQL\Type\Definition\ObjectType;

require('userMutations.php');

$mutations= array();
$mutations += $userMutations;

$rootMutations= new ObjectType([
    'name' => 'Mutation',
    'fields' => $mutations,
]);
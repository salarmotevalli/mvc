<?php

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

require('types.php');
require('query.php');

$schema = new Schema([
    'query' => $rootQuery,
    'mutation' => null,
]);


try {
    $rowInput= file_get_contents('php://input');    
    $input= json_decode($rowInput, true);
    $query = $input['query'];
    $result = GraphQL::executeQuery($schema, $query);

    $output = $result->toArray();
} catch (\Exception $e) {
    $output= [
        'errors' => [
            [
                'message' => $e->getMessage()
            ]
        ]
    ];
}


header('content-type: application/json');
echo json_encode($output);
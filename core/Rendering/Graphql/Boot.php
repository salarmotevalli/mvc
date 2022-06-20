<?php

namespace App\core\Rendering\Graphql;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Boot
{
    public $schema;
    public $rootQuery;
    public $rootMutations;

    public function __construct()
    {
        $this->schema = new Schema([
            'query' => $this->rootQuery,
            'mutation' => $this->rootMutations,
        ]);
    }

    public function output()
    {
        try {
            $rowInput= file_get_contents('php://input');    
            $input= json_decode($rowInput, true);
            $query = $input['query'];
            $result = GraphQL::executeQuery($this->schema, $query);
        
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
    }

    public function echo($output)
    {
        header('content-type: application/json');
        echo json_encode($output);
    }
}

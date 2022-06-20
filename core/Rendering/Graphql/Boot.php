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
        $this->rootQuery= Query::getInstance()->getRoot();
        $this->rootMutations= Mutation::getInstance()->getRoot();
    }

    public function run(): void
    {
        $this->schema = new Schema([
            'query' => $this->rootQuery,
            'mutation' => $this->rootMutations,
        ]);
        $this->echo($this->output());
    }

    public function output(): array
    {
        try {
            $rowInput= file_get_contents('php://input');    
            $input= json_decode($rowInput, true);
            $query = $input['query'];
            $result = GraphQL::executeQuery($this->schema, $query);
        
            return $result->toArray();
        } catch (\Exception $e) {
            return [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }
    }

    public function echo($output): void
    {
        header('content-type: application/json');
        echo json_encode($output);
    }
}

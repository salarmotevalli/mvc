<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

class Boot
{
    public $schema;

    public $rootQuery;

    public $rootMutations;

    public function setRoots(): void
    {
        $this->rootQuery = Query::getInstance()->getRoot();
        $this->rootMutations = Mutation::getInstance()->getRoot();
    }

    public function run(): void
    {
        $schema = new Schema([
            'query' => $this->rootQuery,
            'mutation' => $this->rootMutations,
        ]);

        $this->echo($this->output($schema));
    }

    public function output($schema): array
    {
        try {
            $rowInput = file_get_contents('php://input');
            $input = json_decode($rowInput, true);
            $query = $input['query'];
            $result = GraphQL::executeQuery($schema, $query);

            return $result->toArray();
        } catch (\Exception $e) {
            return [
                'errors' => [
                    [
                        'message' => $e->getMessage(),
                    ],
                ],
            ];
        }
    }

    public function echo($output): void
    {
        header('content-type: application/json');
        echo json_encode($output);
    }
}

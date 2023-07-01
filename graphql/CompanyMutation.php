<?php declare(strict_types=1);

namespace App\Graphql;

use App\core\Rendering\Graphql\implementation\GraphTypes;
use App\core\Rendering\Graphql\Mutation;
use App\models\Company;
use GraphQL\Type\Definition\Type;

class CompanyMutation extends GraphTypes
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
                'type' => CompanyType::getModelType(),
                'description' => 'Add a new company',
                'args' => [
                    'name' => Type::string(),
                    'user_id' => Type::id(),
                    'description' => Type::string(),
                ],
                'resolve' => function ($root, $args) {
                    $company = new Company();
                    $company->name = $args['name'];
                    $company->user_id = $args['user_id'];
                    $company->description = $args['description'];
                    $company->save();

                    return $company->toArray();
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

<?php declare(strict_types=1);

namespace App\Graphql;

use App\core\Rendering\Graphql\implementation\GraphTypes;
use App\core\Rendering\Graphql\Query;
use App\models\Company;
use App\graphql\CompanyType;
use GraphQL\Type\Definition\Type;

class CompanyQuery extends GraphTypes
{
    /**
     * return field of your query in the bewlow method.
     *
     * @return array[]
     */
    public function fields(): array
    {
        return [
            'company' => [
                'type' => CompanyType::getModelType(),
                'args' => [
                    'id' => Type::id(),
                ],
                'resolve' => function ($root, $args) {
                    return Company::find($args['id'])->toArray();
                },
            ],
            'companies' => [
                'type' => Type::listOf(CompanyType::getModelType()),
                'resolve' => function ($root, $args) {
                    return Company::all()->toArray();
                },
            ],
        ];
    }

    public function getType(): string
    {
        return Query::class;
    }
}

<?php

namespace App\core\Rendering\Graphql\implementation;

use App\core\Rendering\Graphql\Mutation;
use App\core\Rendering\Graphql\Query;
use App\core\Rendering\Graphql\Type;

interface GraphTypesInterface
{
    public function fields();

    public function setFields();


    /**
     * @return Mutation|Type|Query
     */
    public function getType(): Mutation|Type|Query;

}
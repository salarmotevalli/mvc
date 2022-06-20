<?php

namespace App\core\Rendering\Graphql\implementation;

use App\core\Rendering\Graphql\Mutation;
use App\core\Rendering\Graphql\Query;
use App\core\Rendering\Graphql\Type;

abstract class GraphTypes implements GraphTypesInterface
{
    public function setFields()
    {
        $this->getType()::getInstance()->set($this->fields());
    }



}
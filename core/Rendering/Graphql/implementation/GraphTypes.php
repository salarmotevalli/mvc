<?php

namespace App\core\Rendering\Graphql\implementation;

abstract class GraphTypes implements GraphTypesInterface
{
    public function setFields()
    {
        $this->getType()::getInstance()->setFields($this->fields());
    }



}
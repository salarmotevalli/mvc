<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql\implementation;

abstract class GraphTypes implements GraphTypesInterface
{
    public function setField(): void
    {
        $this->getType()::getInstance()->setField($this->fields());
    }
}

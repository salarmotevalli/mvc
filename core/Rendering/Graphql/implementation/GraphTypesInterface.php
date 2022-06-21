<?php

namespace App\core\Rendering\Graphql\implementation;

interface GraphTypesInterface
{
    public function fields(): array;

    public function setField():void;

    /**
     * @return string
     */
    public function getType(): string;

}
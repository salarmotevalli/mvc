<?php declare(strict_types=1);

namespace App\core\Rendering\Graphql\implementation;

interface GraphTypesInterface
{
    public function fields(): array;

    public function setField(): void;

    public function getType(): string;
}

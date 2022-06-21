<?php

namespace App\core\Rendering\Graphql\implementation;

interface GraphqlControllerInterface
{
    public function index(): void;
    public function setMutationFields(): void;
    public function setQueryFields(): void;
}
<?php

namespace App\controllers;

use App\core\Db\Connection;
use App\core\Rendering\Graphql\Boot;
use App\core\Rendering\Graphql\implementation\GraphqlControllerInterface;
use App\core\Rendering\Graphql\Mutation;
use App\core\Rendering\Graphql\Query;
use App\Graph\UserQuery;

class GraphqlController extends \App\core\Controller implements GraphqlControllerInterface
{
    public function index(): void
    {
        Connection::connect();
        $boot= new Boot();
        $this->setMutationFields();
        $this->setQueryFields();
        $boot->setRoots();
        $boot->run();
    }

    public function setMutationFields(): void
    {

    }

    public function setQueryFields(): void
    {
        (new UserQuery())->setField();
    }
}
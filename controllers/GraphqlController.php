<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Db\Connection;
use App\core\Rendering\Graphql\Boot;
use App\core\Rendering\Graphql\implementation\GraphqlControllerInterface;
use App\Graphql\UserQuery;

class GraphqlController extends Controller implements GraphqlControllerInterface
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


    /**
     * you should register your mutations or queries
     */

    public function setMutationFields(): void
    {

    }

    public function setQueryFields(): void
    {
        (new UserQuery())->setField();
    }
}
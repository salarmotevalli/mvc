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
     * you can make query and mutation classes
     * such as --App\Graphql\UserQuery-- and
     * register them in the below methods
     */

    public function setMutationFields(): void
    {

    }

    public function setQueryFields(): void
    {
        (new UserQuery())->setField();
    }
}
<?php

namespace App\core;

use Doctrine\DBAL\Connection;
use GraphQL\Executor\Executor;
use Psr\Log\LoggerInterface;

class GraphqlController
{
    protected $db;
    protected $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->db = $connection;
        $this->logger = $logger;
    }

    public function index(Request $request, Response $response)
    {
        $this->setResolvers(include dirname(__DIR__, 3) . '/graphql/resolvers.php');

        $schema = \GraphQL\Utils\BuildSchema::build(file_get_contents(dirname(__DIR__, 3) . '/src/GraphQL/schema.graphqls'));

        $input = $request->getBody();
        $query = $input['query'];

        $variables = isset($input['variables']) ? $input['variables'] : null;
        $context = [
//            'loaders' => $dataLoaders->build($promiseAdapter),
            'db'      => $this->db,
            'logger'  => $this->logger
        ];

        $result = \GraphQL\GraphQL::executeQuery($schema, $query, null, $context, $variables);

        # Create server configuration
        $config = \GraphQL\Server\ServerConfig::create()
            ->setSchema($schema)
            ->setContext($context)
            ->setQueryBatching(true);

# Allow GraphQL Server to handle the request and response
        $server = new \GraphQL\Server\StandardServer($config);
        $response = $server->processPsrRequest($request, $response, $response->getBody());

        # This line is not needed if you use StandardServer
        $response->getBody()->write(json_encode($result));

        $sqlQueryLogger = $this->db->getConfiguration()->getSQLLogger();
        $this->logger->info(json_encode($sqlQueryLogger->queries));

        return $response->withHeader('Content-Type', 'application/json');

    }


    private function setResolvers($resolvers)
    {
        Executor::setDefaultFieldResolver(function ($source, $args, $context, \GraphQL\Type\Definition\ResolveInfo $info) use ($resolvers) {
            $fieldName = $info->fieldName;

            if (is_null($fieldName)) {
                throw new \Exception('Could not get $fieldName from ResolveInfo');
            }

            if (is_null($info->parentType)) {
                throw new \Exception('Could not get $parentType from ResolveInfo');
            }

            $parentTypeName = $info->parentType->name;

            if (isset($resolvers[$parentTypeName])) {
                $resolver = $resolvers[$parentTypeName];

                if (is_array($resolver)) {
                    if (array_key_exists($fieldName, $resolver)) {
                        $value = $resolver[$fieldName];

                        return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                    }
                }

                if (is_object($resolver)) {
                    if (isset($resolver->{$fieldName})) {
                        $value = $resolver->{$fieldName};

                        return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                    }
                }
            }

            return \GraphQL\Executor\Executor::defaultFieldResolver($source, $args, $context, $info);
        });
    }
}
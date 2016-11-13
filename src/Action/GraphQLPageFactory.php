<?php

namespace App\Action;

use App\Factory\SchemaFactory;
use Interop\Container\ContainerInterface;
use Youshido\GraphQL\Execution\Processor;

class GraphQLPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $schema = $container->get(SchemaFactory::class);
        $processor = new Processor($schema);

        return new GraphQLPageAction($processor);
    }
}

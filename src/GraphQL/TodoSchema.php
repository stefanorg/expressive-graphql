<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.19
 */

namespace App\GraphQL;


use App\GraphQL\Mutation\MutationType;
use App\GraphQL\Query\QueryType;
use Interop\Container\ContainerInterface;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;

class TodoSchema extends AbstractSchema
{
    private $container;

    public function __construct(ContainerInterface $container, array $config)
    {
        $this->container = $container;

        parent::__construct($config);
    }


    public function build(SchemaConfig $config)
    {
        $config->setQuery(new QueryType())
                ->setMutation(new MutationType());
    }

}
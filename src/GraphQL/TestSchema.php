<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 15/11/16
 * Time: 9.05
 */

namespace App\GraphQL;


use App\GraphQL\Field\CurrentTimeField;
use App\Resolver\FooResolver;
use GraphQLMiddleware\Container\ContainerAwareInterface;
use Interop\Container\ContainerInterface;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Schema\AbstractSchema;
use Youshido\GraphQL\Type\Scalar\StringType;

class TestSchema extends AbstractSchema implements ContainerAwareInterface
{
    private $container;

    public function __construct(ContainerInterface $container, $config = [])
    {
        $this->container = $container;

        parent::__construct($config);
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function build(SchemaConfig $config)
    {
        $config->getQuery()->addFields([
            new CurrentTimeField(),
            'foo' => [
                'type' => new StringType(),
                'resolve' => [ FooResolver::class, "resolve" ]
            ]
        ]);
    }


}
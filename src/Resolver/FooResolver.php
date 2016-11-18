<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 16/11/16
 * Time: 11.37
 */

namespace App\Resolver;


use App\Entity\Foo;
use Doctrine\ORM\EntityManager;
use GraphQLMiddleware\Resolver\AbstractResolver;
use Youshido\GraphQL\Execution\ResolveInfo;

class FooResolver extends AbstractResolver
{
    function __invoke($value, array $args, ResolveInfo $info)
    {
        return $this->resolve($value, $args, $info);
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get(EntityManager::class);
        $repository = $em->getRepository(Foo::class);
        /** @var Foo $foo */
        $foo = $repository->find(1);

        return $foo->getName();
    }
}
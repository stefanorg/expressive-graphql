<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 14/11/16
 * Time: 15.05
 */

namespace App\GraphQL\Field;


use App\Resolver\CurrentTimeResolver;
use GraphQLMiddleware\Field\AbstractContainerAwareField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\Scalar\StringType;

class CurrentTimeField extends AbstractContainerAwareField
{
    public function getType()
    {
        return new StringType();
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        /** @var \GraphQLMiddleware\Resolver\ResolverInterface $resolve */
        $resolve = $this->getContainer()->get(CurrentTimeResolver::class);
        return $resolve->resolve($value, $args, $info);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 14/11/16
 * Time: 12.33
 */

namespace App\Resolver;


use GraphQLMiddleware\Resolver\AbstractResolver;
use Youshido\GraphQL\Execution\ResolveInfo;

class CurrentTimeResolver extends AbstractResolver
{
    public function resolve($value, array $args, ResolveInfo $info)
    {
        return date('Y-m-d H:ia');
    }
}
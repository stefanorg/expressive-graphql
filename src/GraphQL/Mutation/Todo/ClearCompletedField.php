<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.22
 */

namespace App\GraphQL\Mutation\Todo;


use App\GraphQL\Type\TodoType;
use App\Resolver\TodoResolver;
use GraphQLMiddleware\Field\AbstractContainerAwareField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;

class ClearCompletedField extends AbstractContainerAwareField
{

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return $this->getContainer()->get(TodoResolver::class)->clearCompleted();
    }

    public function getType()
    {
        return new ListType(new TodoType());
    }

}
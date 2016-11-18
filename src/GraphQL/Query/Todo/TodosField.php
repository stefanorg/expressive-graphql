<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.27
 */

namespace App\GraphQL\Query\Todo;


use App\GraphQL\Type\TodoType;
use App\Resolver\TodoResolver;
use GraphQLMiddleware\Field\AbstractContainerAwareField;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;

class TodosField extends AbstractContainerAwareField
{
    public function getType()
    {
        return new ListType(new TodoType());
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        /** @var $resolver TodoResolver */
        $resolver = $this->getContainer()->get(TodoResolver::class);
        return $resolver->findAll();
    }
}
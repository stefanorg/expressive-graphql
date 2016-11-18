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
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

class AddTodoField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'title' => new NonNullType(new StringType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return $this->getContainer()->get(TodoResolver::class)->create($args['title']);
    }

    public function getType()
    {
        return new ListType(new TodoType());
    }

    public function getName()
    {
        return 'add';
    }
}
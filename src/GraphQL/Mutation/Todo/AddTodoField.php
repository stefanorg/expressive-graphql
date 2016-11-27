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
use Respect\Validation\Validator as v;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;

class AddTodoField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'title' => new NonNullType(new StringType()),
            'tags' => new ListType(new StringType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
        return $this->getContainer()->get(TodoResolver::class)->create($args['title']);
    }

    public function getValidationRules()
    {
        return [
            'title' => v::stringType()->alpha()->noWhitespace(),
            'tags' => v::arrayVal()->each(v::alpha()->length(1,10))
        ];
    }

    public function getCustomValidationMessages()
    {
        return [
            'alpha' => "{{name}} alphanumeric only allowed",
            'length' => "{{name}} is too long, {{maxValue}} chars allowed",
            'noWhitespace' => "{{name}} no withespace allowed"
        ];
    }


    public function validate(array $args, ResolveInfo $info, bool $stopOnFirstError = true)
    {
        parent::validate($args, $info, false);
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
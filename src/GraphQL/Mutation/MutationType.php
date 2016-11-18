<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.22
 */

namespace App\GraphQL\Mutation;

use App\GraphQL\Mutation\Todo\AddTodoField;
use App\GraphQL\Mutation\Todo\ClearCompletedField;
use App\GraphQL\Mutation\Todo\DestroyField;
use App\GraphQL\Mutation\Todo\SaveField;
use App\GraphQL\Mutation\Todo\ToggleAllField;
use App\GraphQL\Mutation\Todo\ToggleField;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class MutationType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            new AddTodoField(),
            new ToggleAllField(),
            new ToggleField(),
            new DestroyField(),
            new SaveField(),
            new ClearCompletedField()
        ]);
    }
}
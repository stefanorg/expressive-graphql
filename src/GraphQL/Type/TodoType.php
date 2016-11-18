<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.28
 */

namespace App\GraphQL\Type;


use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;

class TodoType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            'id' => new NonNullType(new IdType()),
            'title' => new StringType(),
            'completed' => new BooleanType()
        ]);
    }

}
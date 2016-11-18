<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 18/11/16
 * Time: 11.21
 */

namespace App\GraphQL\Query;

use App\GraphQL\Query\Todo\TodosField;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class QueryType extends AbstractObjectType
{
    public function build($config)
    {
        $config->addFields([
            new TodosField()
        ]);
    }
}
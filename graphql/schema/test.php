<?php

use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;

return [
    'query' => new ObjectType([
       'name' => 'RootTypeQuery',
       'fields' => [
           'currentTime' => [
               'type' => new StringType(),
               'resolve' => function() {
                   return date('Y-m-d H:ia');
               }
           ]
       ]
    ])
];
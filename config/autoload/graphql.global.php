<?php

return [
    "dependencies" => [
        "factories" => [
            \App\Resolver\CurrentTimeResolver::class => \GraphQLMiddleware\Resolver\ContainerAwareResolverFactory::class,
            \App\Resolver\FooResolver::class => \GraphQLMiddleware\Resolver\ContainerAwareResolverFactory::class,
            \App\GraphQL\TestSchema::class => \App\GraphQL\TestSchemaFactory::class,
            \App\Resolver\TodoResolver::class => \App\Resolver\DoctrineResolverFactory::class,
            \App\GraphQL\TodoSchema::class => \App\GraphQL\TodoSchemaFactory::class
        ]
    ],
    "graphql" => [
        "schema" => \App\GraphQL\TodoSchema::class
    ],
];
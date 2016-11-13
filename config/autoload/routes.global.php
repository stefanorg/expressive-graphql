<?php
use App\Action;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
        'factories' => [
            Action\GraphQLPageAction::class  => Action\GraphQLPageFactory::class,
            Action\GraphiQLPageAction::class => Action\GraphiQLPageFactory::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\GraphiQLPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'graphiql',
            'path' => '/graphiql',
            'middleware' => App\Action\GraphiQLPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'graphql',
            'path' => '/graphql',
            'middleware' => \App\Action\GraphQLPageAction::class,
            'allowed_methods' => ['GET', 'POST'],
        ],
    ],
];

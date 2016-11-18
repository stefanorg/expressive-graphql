<?php
use App\Action;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => \GraphiQLExtension\Action\GraphiQLPageAction::class,
            'allowed_methods' => ['GET'],
        ]
    ],
];
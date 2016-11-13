<?php
use Zend\Expressive\Application;
use Zend\Expressive\Container\ApplicationFactory;
use Zend\Expressive\Helper;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'invokables' for constructor-less services, or services that do
        // not require arguments to the constructor. Map a service name to the
        // class name.
        'invokables' => [
            // Fully\Qualified\InterfaceName::class => Fully\Qualified\ClassName::class,
            Helper\ServerUrlHelper::class => Helper\ServerUrlHelper::class
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            'doctrine.entity_manager.orm_default'     => \ContainerInteropDoctrine\EntityManagerFactory::class,
            \Doctrine\ORM\EntityManager::class        => \ContainerInteropDoctrine\EntityManagerFactory::class,
            Application::class                        => ApplicationFactory::class,
            Helper\UrlHelper::class                   => Helper\UrlHelperFactory::class,
            \App\Factory\SchemaFactory::class         => \App\Factory\SchemaFactory::class,
            \App\Console\Test::class                  => \App\Console\TestFactory::class
        ],
    ],
];
<?php
/**
 * Created by PhpStorm.
 * User: stefano
 * Date: 17/11/16
 * Time: 11.05
 */

namespace App\GraphQL;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TodoSchemaFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TodoSchema($container, []);
    }
}
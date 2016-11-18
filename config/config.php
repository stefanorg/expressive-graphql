<?php

use Zend\Expressive\ConfigManager\ConfigManager;
use Zend\Expressive\ConfigManager\PhpFileProvider;

$configManager = new ConfigManager([
    \GraphQLMiddleware\ModuleConfig::class,
    \GraphiQLExtension\ModuleConfig::class,
    new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
]);

return new ArrayObject($configManager->getMergedConfig());

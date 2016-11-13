#!/usr/bin/env php
<?php

namespace App;

use Zend\Console\Console;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use ZF\Console\Application;

chdir(__DIR__ . '/../');
require_once 'vendor/autoload.php';

define('VERSION', '0.0.1');

$container = require 'config/container.php';

// Hack, to ensure routes are properly injected
$container->get('Zend\Expressive\Application');

$routes = [
  [
      'name' => 'test',
      // 'route' => '[--path=]',
      'description' => 'Test console action.',
      'short_description' => 'Test console action.',
      'options_descriptions' => [
          // '--path'   => 'Base path of the application; posts are expected at $path/data/blog/',
      ],
      'defaults' => [
          'path'   => realpath(getcwd()),
      ],
      'handler' => function ($route, $console) use ($container) {
          $handler = $container->get(\App\Console\Test::class);
          return $handler($route, $console);
      },
  ],
];

$app = new Application(
    'expressive graphql server',
    VERSION,
    $routes,
    Console::getInstance()
);
$exit = $app->run();
exit($exit);

<?php

namespace App\Console;

use Youshido\GraphQL\Execution\Processor;
use Youshido\GraphQL\Schema\Schema;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Diactoros\Request;
use ZF\Console\Route;

class Test
{


    /**
     * @var Schema
     */
    private $schema;

    private $processor;

    /**
     * Test constructor.
     */
    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    public function __invoke(Route $route, Console $console) : int
    {
        $console->write('Test console action ... ');
        $query = <<<EOQ
{
  currentTime
}
EOQ;

        $this->processor->processPayload('{ currentTime }');

        $data = $this->processor->getResponseData();

        $console->write(json_encode($data));

        return 0;
    }
}

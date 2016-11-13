<?php

namespace App\Console;

use Youshido\GraphQL\Execution\Processor;
use Youshido\GraphQL\Schema\Schema;
use Zend\Console\Adapter\AdapterInterface as Console;
use ZF\Console\Route;

class Test {


  /**
   * @var Schema
   */
  private $schema;

  /**
   * Test constructor.
   */
  public function __construct(Schema $schema)
  {
    $this->schema = $schema;
  }

  public function __invoke(Route $route, Console $console) : int
  {

      $console->write('Test console action ... ');
      $query =<<<EOQ
{
  currentTime
}
EOQ;

      $processor = new Processor($this->schema);

      $processor->processPayload('{ currentTime }');

      $data = $processor->getResponseData();

      $console->write(json_encode($data));

      return 0;
  }
}

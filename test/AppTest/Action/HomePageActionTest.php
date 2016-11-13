<?php

namespace AppTest\Action;

use App\Action\GraphiQLPageAction;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Router\RouterInterface;

class HomePageActionTest extends \PHPUnit_Framework_TestCase
{
    /** @var RouterInterface */
    protected $router;

    protected function setUp()
    {
        $this->router = $this->prophesize(RouterInterface::class);
    }

    public function testResponse()
    {
        $homePage = new GraphiQLPageAction($this->router->reveal(), null);
        $response = $homePage(new ServerRequest(['/']), new Response(), function () {
        });

        $this->assertTrue($response instanceof Response);
    }
}

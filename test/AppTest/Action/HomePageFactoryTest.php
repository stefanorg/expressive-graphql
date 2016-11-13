<?php

namespace AppTest\Action;

use App\Action\GraphiQLPageAction;
use App\Action\GraphiQLPageFactory;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomePageFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithoutTemplate()
    {
        $factory = new GraphiQLPageFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);

        $this->assertTrue($factory instanceof GraphiQLPageFactory);

        $homePage = $factory($this->container->reveal());

        $this->assertTrue($homePage instanceof GraphiQLPageAction);
    }

    public function testFactoryWithTemplate()
    {
        $factory = new GraphiQLPageFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $this->assertTrue($factory instanceof GraphiQLPageFactory);

        $homePage = $factory($this->container->reveal());

        $this->assertTrue($homePage instanceof GraphiQLPageAction);
    }
}

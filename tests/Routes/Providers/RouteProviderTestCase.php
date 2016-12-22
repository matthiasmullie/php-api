<?php

namespace MatthiasMullie\Api\Tests\Routes\Providers;

use MatthiasMullie\Api\Routes\Providers\Exception;
use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;
use PHPUnit_Framework_TestCase;

abstract class RouteProviderTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $input
     *
     * @return RouteProviderInterface
     */
    abstract public function getProvider(string $input) : RouteProviderInterface;

    /**
     * @expectedException Exception
     */
    public function testInvalidHandler()
    {
        $provider = $this->getProvider('invalid_handler');
        $provider->getRoutes()->current();
    }

    public function testInvocableClassHandler()
    {
        $provider = $this->getProvider('invocable_class_handler');
        $route = $provider->getRoutes()->current();

        $this->assertEquals(['POST'], $route->getMethods());
        $this->assertEquals('/test', $route->getPath());
        $this->assertInstanceOf('MatthiasMullie\Api\Tests\Controllers\TestController', $route->getHandler());
    }

    public function testStaticMethodHandler()
    {
        $provider = $this->getProvider('static_method_handler');
        $route = $provider->getRoutes()->current();

        $this->assertEquals(['POST'], $route->getMethods());
        $this->assertEquals('/test', $route->getPath());
        $this->assertTrue(is_callable($route->getHandler()));
    }

    public function testStaticMethod2Handler()
    {
        $provider = $this->getProvider('static_method_2_handler');
        $route = $provider->getRoutes()->current();

        $this->assertEquals(['POST'], $route->getMethods());
        $this->assertEquals('/test', $route->getPath());
        $this->assertTrue(is_callable($route->getHandler()));
    }

    public function testMultipleValidRoutes()
    {
        $provider = $this->getProvider('multiple_valid_routes');
        $routes = $provider->getRoutes();

        $count = 0;
        foreach ($routes as $route) {
            ++$count;
        }

        $this->assertEquals(2, $count);
    }
}

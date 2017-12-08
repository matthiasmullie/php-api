<?php

namespace MatthiasMullie\Api\Tests\Routes;

use MatthiasMullie\Api\Routes\Route;
use MatthiasMullie\Api\Tests\Controllers\TestController;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testOneMethod()
    {
        $handler = new TestController();
        $route = new Route(['GET'], '/index', $handler);

        $this->assertEquals(['GET'], $route->getMethods());
        $this->assertEquals('/index', $route->getPath());
        $this->assertEquals($handler, $route->getHandler());
    }

    public function testMultipleMethods()
    {
        $handler = new TestController();
        $route = new Route(['GET', 'POST'], '/index', $handler);

        $this->assertEquals(['GET', 'POST'], $route->getMethods());
        $this->assertEquals('/index', $route->getPath());
        $this->assertEquals($handler, $route->getHandler());
    }

    /**
     * @expectedException TypeError
     */
    public function testInvalidHandler()
    {
        new Route('GET', '/index', null);
    }
}

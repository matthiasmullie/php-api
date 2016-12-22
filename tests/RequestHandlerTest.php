<?php

namespace MatthiasMullie\Api\Tests;

use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;
use MatthiasMullie\Api\Routes\Providers\YamlRouteProvider;

class RequestHandlerTest extends RequestHandlerTestCase
{
    use RequestHandlerTestTrait;

    /**
     * {@inheritdoc}
     */
    protected function getRoutes(): RouteProviderInterface
    {
        return new YamlRouteProvider(__DIR__.'/../config/routes.yml');
    }

    /**
     * @runInSeparateProcess
     */
    public function testOutput()
    {
        $response = $this->request('GET', '/');

        ob_start();
        $this->handler->output($response);
        $content = ob_get_clean();

        $this->assertEquals('{"status_code":200,"data":[]}', $content);
    }
}

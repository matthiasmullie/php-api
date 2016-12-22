<?php

namespace MatthiasMullie\Api\TestHelpers;

use GuzzleHttp\Psr7\ServerRequest;
use MatthiasMullie\Api\RequestHandler;
use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;
use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * API end-to-end testcase without performing the requests on an actual (local)
 * web server, just passing it through the (supposedly) starting point.
 * This is faster than HttpTest, although I'd suggest to run at least a minor
 * test through HttpTest, to make sure bootstrapping is fine. But for testing
 * controller logic, this is going to be faster!
 */
abstract class RequestHandlerTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var RequestHandler
     */
    protected $handler;

    /**
     * @return RouteProviderInterface
     */
    abstract protected function getRoutes() : RouteProviderInterface;

    public function setUp()
    {
        $routes = $this->getRoutes();
        $this->handler = new RequestHandler($routes);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $get
     * @param array  $post
     *
     * @return ResponseInterface
     */
    public function request($method, $uri, array $get = [], array $post = [])
    {
        $request = new ServerRequest($method, $uri);
        $request = $request
            ->withQueryParams($get)
            ->withParsedBody($post);

        return $this->handler->route($request);
    }
}

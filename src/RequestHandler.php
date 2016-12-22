<?php

namespace MatthiasMullie\Api;

use GuzzleHttp\Psr7\Response;
use League\Route\RouteCollection;
use League\Route\Strategy\JsonStrategy;
use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class RequestHandler
{
    /**
     * @var RouteCollection
     */
    protected $router;

    /**
     * @param RouteProviderInterface $routes
     */
    public function __construct(RouteProviderInterface $routes)
    {
        $this->router = new RouteCollection();
        $this->router->setStrategy(new JsonStrategy());
        foreach ($routes->getRoutes() as $route) {
            $this->router->map(
                $route->getMethods(),
                $route->getPath(),
                $route->getHandler()
            );
        }
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function route(ServerRequestInterface $request) : ResponseInterface
    {
        $response = $this->router->dispatch($request, new Response());

        // JsonStrategy will automatically add a Content-Type: application/json
        // header to the response, but without it being capitalized
        $contentType = $response->getHeader('content-type');
        if ($contentType) {
            $response = $response->withoutHeader('content-type');
            $response = $response->withHeader('Content-Type', $contentType);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     */
    public function output(ResponseInterface $response)
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }
        echo $response->getBody();
    }
}

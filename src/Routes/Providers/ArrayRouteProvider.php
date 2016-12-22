<?php

namespace MatthiasMullie\Api\Routes\Providers;

use MatthiasMullie\Api\Routes\Route;
use Generator;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class ArrayRouteProvider implements RouteProviderInterface
{
    /**
     * @var array[]
     */
    protected $routes = [];

    /**
     * @param array[] $data
     */
    public function __construct(array $data)
    {
        $this->routes = $data;
    }

    /**
     * @return Generator
     */
    public function getRoutes() : Generator
    {
        foreach ($this->routes as $data) {
            yield new Route(
                $this->getMethods($data),
                $this->getPath($data),
                $this->getHandler($data)
            );
        }
    }

    /**
     * @param array $data
     *
     * @return string[]
     *
     * @throws Exception
     */
    protected function getMethods(array $data) : array
    {
        if (!isset($data['method'])) {
            $serialized = serialize($data);
            throw new Exception("Missing method. (input: $serialized)");
        }

        return (array) $data['method'];
    }

    /**
     * @param array $data
     *
     * @return string
     *
     * @throws Exception
     */
    protected function getPath(array $data) : string
    {
        if (!isset($data['path'])) {
            $serialized = serialize($data);
            throw new Exception("Missing path. (input: $serialized)");
        }

        return $data['path'];
    }

    /**
     * @param array $data
     *
     * @return callable
     *
     * @throws Exception
     */
    protected function getHandler(array $data) : callable
    {
        if (!isset($data['handler'])) {
            $serialized = serialize($data);
            throw new Exception("Missing handler. (input: $serialized)");
        }

        $handler = $data['handler'];

        if (is_callable($handler)) {
            return $handler;
        }

        if (is_string($handler) && method_exists($handler, '__invoke')) {
            return new $handler();
        }

        $serialized = serialize($data);
        throw new Exception("Handler must be callable. (input: $serialized)");
    }
}

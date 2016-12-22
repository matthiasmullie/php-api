<?php

namespace MatthiasMullie\Api\Tests\Routes\Providers;

use MatthiasMullie\Api\Routes\Providers\JsonRouteProvider;
use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;

class JsonProviderTest extends RouteProviderTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getProvider(string $input) : RouteProviderInterface
    {
        return new JsonRouteProvider(__DIR__."/../Config/Json/$input.json");
    }
}

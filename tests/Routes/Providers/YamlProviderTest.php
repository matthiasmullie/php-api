<?php

namespace MatthiasMullie\Api\Tests\Routes\Providers;

use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;
use MatthiasMullie\Api\Routes\Providers\YamlRouteProvider;

class YamlProviderTest extends RouteProviderTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getProvider(string $input) : RouteProviderInterface
    {
        return new YamlRouteProvider(__DIR__."/../Config/Yaml/$input.yml");
    }
}

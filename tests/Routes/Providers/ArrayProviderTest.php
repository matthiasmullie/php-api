<?php

namespace MatthiasMullie\Api\Tests\Routes\Providers;

use MatthiasMullie\Api\Routes\Providers\ArrayRouteProvider;
use MatthiasMullie\Api\Routes\Providers\RouteProviderInterface;

class ArrayProviderTest extends RouteProviderTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getProvider(string $input): RouteProviderInterface
    {
        $array = include __DIR__."/../Config/Array/$input.php";

        return new ArrayRouteProvider($array);
    }
}

<?php

namespace MatthiasMullie\Api\Routes\Providers;

use Generator;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
interface RouteProviderInterface
{
    /**
     * @return Generator
     */
    public function getRoutes() : Generator;
}

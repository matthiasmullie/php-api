<?php

namespace MatthiasMullie\Api\Routes\Providers;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class JsonRouteProvider extends ArrayRouteProvider implements RouteProviderInterface
{
    /**
     * @param string $path Path to route data
     */
    public function __construct(string $path)
    {
        $contents = file_get_contents($path);
        $data = json_decode($contents, true);
        parent::__construct($data);
    }
}

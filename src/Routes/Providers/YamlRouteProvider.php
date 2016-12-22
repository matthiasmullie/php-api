<?php

namespace MatthiasMullie\Api\Routes\Providers;

use Symfony\Component\Yaml\Yaml;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class YamlRouteProvider extends ArrayRouteProvider implements RouteProviderInterface
{
    /**
     * @param string $path Path to route data
     * @throws Exception
     */
    public function __construct(string $path)
    {
        if (!class_exists('Symfony\Component\Yaml\Yaml')) {
            throw new Exception('Yaml not installed. composer require symfony/yaml');
        }

        $contents = file_get_contents($path);
        $data = Yaml::parse($contents);
        parent::__construct($data);
    }
}

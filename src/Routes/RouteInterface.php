<?php

namespace MatthiasMullie\Api\Routes;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
interface RouteInterface
{
    /**
     * @return string[]
     */
    public function getMethods() : array;

    /**
     * @return string
     */
    public function getPath() : string;

    /**
     * @return callable
     */
    public function getHandler() : callable;
}

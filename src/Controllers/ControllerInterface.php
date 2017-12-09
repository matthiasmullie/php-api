<?php

namespace MatthiasMullie\Api\Controllers;

use League\Route\Http\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
interface ControllerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return ResponseInterface
     *
     * @throws Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;
}

<?php

namespace MatthiasMullie\Api\Tests\Controllers;

use MatthiasMullie\Api\Controllers\ControllerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class TestController implements ControllerInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, array $args)
    {
        return static::handle($request, $args);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $args
     *
     * @return array
     */
    public static function handle(ServerRequestInterface $request, array $args)
    {
        return [
            'GET' => $request->getQueryParams(),
            'POST' => $request->getParsedBody(),
            'args' => $args,
        ];
    }
}

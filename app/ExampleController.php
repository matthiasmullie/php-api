<?php

namespace MatthiasMullie\Api\App;

use MatthiasMullie\Api\Controllers\ControllerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author Matthias Mullie <php-api@mullie.eu>
 * @copyright Copyright (c) 2016, Matthias Mullie. All rights reserved
 * @license LICENSE MIT
 */
class ExampleController implements ControllerInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, array $args)
    {
        // output the data that was received by various methods
        $data = [
            'GET' => $request->getQueryParams(),
            'POST' => $request->getParsedBody(),
            'args' => $args,
        ];

        return [
            'status_code' => 200,
            'data' => array_filter($data),
        ];
    }
}

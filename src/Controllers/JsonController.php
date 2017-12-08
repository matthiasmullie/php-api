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
abstract class JsonController implements ControllerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return array|ResponseInterface
     *
     * @throws Exception
     */
    abstract public function invoke(ServerRequestInterface $request, ResponseInterface $response, array $args);

    /**
     * {@inheritdoc}
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $result = $this->invoke($request, $response, $args);

        $response->withAddedHeader('Content-Type', 'application/json');

        if ($response->getBody()->isWritable()) {
            $response->getBody()->write(json_encode($result));
        }

        return $response->withStatus(isset($result['status_code']) ? $result['status_code'] : 200);
    }
}

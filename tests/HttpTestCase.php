<?php

namespace MatthiasMullie\Api\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * API end-to-end test that performs API requests to an actual (local) web
 * server, and verifies the results.
 * This is slower than RequestHandlerTestCase, but I suggest doing at least one
 * of these just to verify the bootstrapping. RequestHandlerTestCase can then
 * be used to test the controller logic.
 */
abstract class HttpTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost',
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $get
     * @param array  $post
     *
     * @return ResponseInterface
     */
    public function request($method, $uri, array $get = [], array $post = [])
    {
        $options = [
            'query' => $get,
            'form_params' => $post,
        ];

        try {
            return $this->client->request($method, $uri, $options);
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }
}

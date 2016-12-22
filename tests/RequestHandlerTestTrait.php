<?php

namespace MatthiasMullie\Api\Tests;

trait RequestHandlerTestTrait
{
    public function testValidRequest()
    {
        $response = $this->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":200,"data":[]}', (string) $response->getBody());
    }

    public function testGetParams()
    {
        $response = $this->request('GET', '/', ['hello' => 'world']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":200,"data":{"GET":{"hello":"world"}}}', (string) $response->getBody());
    }

    public function testPostParams()
    {
        $response = $this->request('POST', '/', [], ['hello' => 'world']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":200,"data":{"POST":{"hello":"world"}}}', (string) $response->getBody());
    }

    public function testArgs()
    {
        $response = $this->request('GET', '/hello/matthias');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":200,"data":{"args":{"name":"matthias"}}}', (string) $response->getBody());
    }

    public function testBadRoute()
    {
        $response = $this->request('GET', '/non-existing');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":404,"reason_phrase":"Not Found"}', (string) $response->getBody());
    }

    public function testMissingArg()
    {
        $response = $this->request('GET', '/hello');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":404,"reason_phrase":"Not Found"}', (string) $response->getBody());
    }

    public function testBadMethod()
    {
        $response = $this->request('POST', '/hello/matthias');

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertArraySubset(['Content-Type' => ['application/json']], $response->getHeaders());
        $this->assertEquals('{"status_code":405,"reason_phrase":"Method Not Allowed"}', (string) $response->getBody());
    }
}

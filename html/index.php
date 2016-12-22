<?php

use GuzzleHttp\Psr7\ServerRequest;
use MatthiasMullie\Api\RequestHandler;
use MatthiasMullie\Api\Routes\Providers\YamlRouteProvider;

require __DIR__.'/../vendor/autoload.php';

$routes = new YamlRouteProvider(__DIR__.'/../config/routes.yml');
$handler = new RequestHandler($routes);
$response = $handler->route(ServerRequest::fromGlobals());
$handler->output($response);

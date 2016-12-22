# php-api

[![Build status](https://api.travis-ci.org/matthiasmullie/php-api.svg?branch=master)](https://travis-ci.org/matthiasmullie/php-api)
[![Code coverage](http://img.shields.io/codecov/c/github/matthiasmullie/php-api.svg)](https://codecov.io/github/matthiasmullie/php-api)
[![Code quality](http://img.shields.io/scrutinizer/g/matthiasmullie/php-api.svg)](https://scrutinizer-ci.com/g/matthiasmullie/php-api)
[![Latest version](http://img.shields.io/packagist/v/matthiasmullie/php-api.svg)](https://packagist.org/packages/matthiasmullie/php-api)
[![Downloads total](http://img.shields.io/packagist/dt/matthiasmullie/php-api.svg)](https://packagist.org/packages/matthiasmullie/php-api)
[![License](http://img.shields.io/packagist/l/matthiasmullie/php-api.svg)](https://github.com/matthiasmullie/php-api/blob/master/LICENSE)


## Example usage

Setting up is **really** simple.

You'll need a routing config:

```yml
test:
    method: [GET, POST]
    path: /
    handler: MatthiasMullie\ApiExample\ExampleController
```

A few lines to bootstrap, in a file where all of your requests end up:

```php
$routes = new MatthiasMullie\Api\Routes\Providers\YamlRouteProvider(__DIR__.'/../config/routes.yml');
$handler = new MatthiasMullie\Api\RequestHandler($routes);
$response = $handler->route(GuzzleHttp\Psr7\ServerRequest::fromGlobals());
$handler->output($response);
```

And a controller:

```php
namespace MatthiasMullie\ApiExample;

class ExampleController implements MatthiasMullie\Api\Controllers\ControllerInterface
{
    public function __invoke(Psr\Http\Message\ServerRequestInterface $request, array $args)
    {
        // hey there, I can process your request!

        return [
            'status_code' => 200,
            'hello' => 'world',
        ];
    }
}
```

Or take a look at this exact same example in a clean repo, at
[matthiasmullie/php-api-example](https://github.com/matthiasmullie/php-api-example).


## Installation

Simply add a dependency on matthiasmullie/php-api to your composer.json file
if you use [Composer](https://getcomposer.org/) to manage the dependencies of
your project:

```sh
composer require matthiasmullie/php-api
```

Although it's recommended to use Composer, you can actually include these files
anyway you want.


## License

php-api is [MIT](http://opensource.org/licenses/MIT) licensed.

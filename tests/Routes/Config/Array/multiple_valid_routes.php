<?php

return [
    'one' => [
        'method' => 'POST',
        'path' => '/test',
        'handler' => 'MatthiasMullie\\Api\\Tests\\Controllers\\TestController',
    ],
    'two' => [
        'method' => ['GET', 'POST'],
        'path' => '/another_test/{arg}',
        'handler' => 'MatthiasMullie\\Api\\Tests\\Controllers\\TestController',
    ],
];

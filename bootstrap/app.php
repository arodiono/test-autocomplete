<?php

use Slim\Http\Request;
use Slim\Http\Response;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'username' => '',
            'password' => '',
            'database' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
    ]
]);

$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function () use ($capsule) {
    return $capsule;
};
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../app/Views/');
};
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};
$container['CityController'] = function ($container) {
    return new \App\Controllers\CityController($container);
};

$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {
        $uri = $uri->withPath(substr($path, 0, -1));
        if ($request->getMethod() == 'GET') {
            return $response->withRedirect((string)$uri, 301);
        } else {
            return $next($request->withUri($uri), $response);
        }
    }
    return $next($request, $response);
});

require __DIR__ . '/../app/routes.php';
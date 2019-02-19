<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(dirname(__DIR__)))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // noop
}

// Create the application
$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// $app->withFacades();

// we will be using Eloquent models
$app->withEloquent();

// register container bindings
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// load configuration for barryvdh/laravel-cors and register the provider
$app->configure('cors');
$app->register(Barryvdh\Cors\ServiceProvider::class);

// register middleware
$app->middleware([
    \Barryvdh\Cors\HandleCors::class,
]);

// load the application routes
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

// aaaaaand we're done
return $app;

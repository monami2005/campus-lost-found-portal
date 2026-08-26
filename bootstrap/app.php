<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

// Disable loading config and route cache from local Windows paths in non-Windows environment
if (DIRECTORY_SEPARATOR === '/' || isset($_SERVER['RENDER']) || env('RENDER')) {
    putenv('APP_CONFIG_CACHE=' . __DIR__ . '/cache/production_config.php');
    putenv('APP_ROUTES_CACHE=' . __DIR__ . '/cache/production_routes.php');
    putenv('APP_SERVICES_CACHE=' . __DIR__ . '/cache/production_services.php');
    putenv('APP_PACKAGES_CACHE=' . __DIR__ . '/cache/production_packages.php');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        
        $middleware->alias([
            'admin' => \App\Http\Middleware\EnsureAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

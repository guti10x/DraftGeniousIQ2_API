<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Definir los Middlewares:
        $middleware->alias([
            'checkJWTMiddleware' => JWTMiddleware :: class,
            'checkADMINMiddleware' => AdminMiddleware :: class,
        ]);
        //$middleware->api(\App\Http\Middleware\JWTMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
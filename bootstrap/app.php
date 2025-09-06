<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guesto' => \App\Http\Middleware\GuestMiddleware::class,
            'auth' => \App\Http\Middleware\AuthMiddleware::class,
            'check' => \App\Http\Middleware\CheckRoleOrPermission::class,
            'check.content_access' => \App\Http\Middleware\CheckRoleOrPermission::class,
            'test' => \App\Http\Middleware\TestMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

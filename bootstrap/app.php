<?php

use App\Http\Middleware\ApiAuditLogger;
use App\Http\Middleware\DataValidation;
use App\Http\Middleware\UserAccessibility;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )->withMiddleware(function (Middleware $middleware): void {

        $middleware->api(prepend: [

            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,

            DataValidation::class,

        ]);

        $middleware->alias([

            'admin.access' => UserAccessibility::class,

            'audit' => ApiAuditLogger::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

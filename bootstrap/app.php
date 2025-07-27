<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',        // ここを追加
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->api(append: [
            SubstituteBindings::class,
            'throttle:api',
            // 必要なら他のAPI用ミドルウェアもここに追加
        ]);
    })
    ->withProviders([
        RouteServiceProvider::class, // ← ここを追加
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

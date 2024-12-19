<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
->withRouting(
    using: function () {
        Route::middleware('api')
            ->prefix('api')
            //->name('api.')
            ->group(base_path('routes/api.php'));
    },
     web: __DIR__.'/../routes/web.php',
     api: __DIR__.'/../routes/api.php',
     commands: __DIR__.'/../routes/console.php',
     channels: '/up',
)
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api',[
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // App\Http\Middleware\AddPermissionsToResponse::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

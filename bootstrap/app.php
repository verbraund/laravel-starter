<?php

use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\SetLogContext;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAllowedIps;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function (Application $app, Router $router) {
            $router->middleware('api')
                ->prefix('/api')
                ->as('api.')
                ->group($app->basePath('routes/api.php'));

            $router->middleware('api')
                ->prefix('/api/admin')
                ->group($app->basePath('routes/admin.php'));

            $router->middleware('web')
                ->group($app->basePath('routes/web.php'));
        },
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.ips' => CheckAllowedIps::class,
            'log.context' => SetLogContext::class
        ]);

        $middleware->api(append: ['throttle:global']);
        $middleware->append(SecurityHeaders::class);

        $middleware->trustProxies(
            at: '*',
            headers: SymfonyRequest::HEADER_X_FORWARDED_FOR |
            SymfonyRequest::HEADER_X_FORWARDED_PROTO |
            SymfonyRequest::HEADER_X_FORWARDED_HOST
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();

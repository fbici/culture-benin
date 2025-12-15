<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... (autres tableaux comme $middleware, $middlewareGroups)

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role.admin' => \App\Http\Middleware\CheckAdminRole::class,
        // =========================================================
        // AJOUT CRUCIAL : Lier l'alias 'auth.admin' à la classe
        // =========================================================
        'auth.admin' => \App\Http\Middleware\CheckAdminRole::class, 
        // =========================================================
    ];

    protected $middleware = [
        // ...
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\Cors::class,
    ];
}
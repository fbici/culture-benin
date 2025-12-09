<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTwoFactorEnabled
{
    /**
     * Vérifier que l'utilisateur admin a activé la 2FA
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si c'est un admin/manager et qu'il n'a pas activé la 2FA
        if ($user && $user->isManagerOrAdmin() && !$user->two_factor_confirmed_at) {
            return redirect()->route('admin.2fa.required');
        }

        return $next($request);
    }
}
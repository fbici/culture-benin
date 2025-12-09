<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // 1. Vérifier si l'utilisateur est Manager OU Admin
        if ($user && $user->isManagerOrAdmin()) {
            
            // 2. Vérifier si la 2FA est OBLIGATOIREMENT activée
            if (!$user->two_factor_confirmed_at) {
                // EXCEPTION : permettre l'accès aux pages 2FA
                if ($request->is('admin/2fa*') || $request->route()->getName() === 'admin.2fa.required') {
                    return $next($request);
                }
                return redirect()->route('admin.2fa.required');
            }
            
            // 3. Vérifier si l'utilisateur a déjà passé la 2FA pendant cette session
            if (!$request->session()->get('2fa_verified') && 
                !$request->is('admin/2fa/challenge') &&
                !$request->is('admin/2fa/verify')) {
                return redirect()->route('admin.2fa.challenge');
            }
            
            return $next($request);
        }

        // Si ce n'est ni un admin, ni un manager
        abort(403, 'Accès non autorisé à l\'administration. Rôle insuffisant.');
    }
}
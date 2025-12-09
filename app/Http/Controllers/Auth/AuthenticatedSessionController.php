<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $user = $request->user();

        // Vérifier si c'est un admin/manager
        if ($user && $user->isManagerOrAdmin()) {
            
            // Vérifier si la 2FA est activée
            if (!$user->two_factor_confirmed_at) {
                // Rediriger vers la page d'obligation de 2FA
                return redirect()->route('admin.2fa.required');
            }
            
            // REDIRECTION VERS LE CHALLENGE 2FA (OBLIGATOIRE À CHAQUE CONNEXION)
            return redirect()->route('admin.2fa.challenge');
        }

        // REDIRECTION DES UTILISATEURS NORMALS VERS LEUR DASHBOARD
        return redirect()->intended('/user/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Supprimer aussi la session 2FA
        $request->session()->forget('2fa_verified');

        return redirect('/');
    }
}
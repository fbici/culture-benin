<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorAuthController extends Controller
{
    /**
     * Afficher la page d'activation de la 2FA
     */
    public function show(): View
    {
        $user = auth()->user();
        
        return view('admin.two-factor-auth', [
            'user' => $user,
            'qrCode' => $this->generateQrCode($user),
        ]);
    }

    /**
     * Afficher le challenge 2FA (À CHAQUE CONNEXION)
     */
    public function showChallenge(): View
    {
        $user = auth()->user();
        
        if (!$user->two_factor_confirmed_at) {
            return redirect()->route('admin.2fa.required');
        }

        return view('admin.two-factor-challenge', [
            'user' => $user,
        ]);
    }

    /**
     * Vérifier le code 2FA (À CHAQUE CONNEXION)
     */
    public function verifyChallenge(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();

        // Vérifier le code 2FA normal
        if ($google2fa->verifyKey($user->two_factor_secret, $request->code)) {
            // Marquer la 2FA comme vérifiée pour cette session
            $request->session()->put('2fa_verified', true);
            
            return redirect()->intended('/admin')
                ->with('success', 'Authentification à deux facteurs vérifiée !');
        }

        // Vérifier les codes de récupération
        $recoveryCodes = json_decode($user->two_factor_recovery_codes, true) ?? [];
        if (in_array($request->code, $recoveryCodes)) {
            // Retirer le code de récupération utilisé
            $recoveryCodes = array_diff($recoveryCodes, [$request->code]);
            $user->update(['two_factor_recovery_codes' => json_encode(array_values($recoveryCodes))]);
            
            $request->session()->put('2fa_verified', true);
            return redirect()->intended('/admin')
                ->with('success', 'Code de récupération accepté !');
        }

        return back()->withErrors([
            'code' => 'Le code fourni est invalide.',
        ]);
    }

    /**
     * Activer la 2FA après confirmation (configuration initiale)
     */
    public function confirm(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = auth()->user();
        $google2fa = new Google2FA();

        // Vérifier le code
        if ($google2fa->verifyKey($user->two_factor_secret, $request->code)) {
            $user->forceFill([
                'two_factor_confirmed_at' => now(),
            ])->save();

            // Marquer aussi comme vérifié pour cette session
            $request->session()->put('2fa_verified', true);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Authentification à deux facteurs activée avec succès !');
        }

        return back()->withErrors([
            'code' => 'Le code fourni est invalide.',
        ]);
    }

    /**
     * Désactiver la 2FA
     */
    public function destroy(): RedirectResponse
    {
        $user = auth()->user();
        
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        // Supprimer la session 2FA
        request()->session()->forget('2fa_verified');

        return redirect()->route('admin.2fa.show')
            ->with('success', 'Authentification à deux facteurs désactivée.');
    }

    /**
     * Générer de nouveaux codes de récupération
     */
    public function generateNewRecoveryCodes(): RedirectResponse
    {
        $user = auth()->user();
        
        // Générer 8 codes de récupération
        $recoveryCodes = collect();
        for ($i = 0; $i < 8; $i++) {
            $recoveryCodes->push(bin2hex(random_bytes(5))); // 10 caractères hexadécimaux
        }

        $user->forceFill([
            'two_factor_recovery_codes' => json_encode($recoveryCodes->toArray()),
        ])->save();

        return redirect()->route('admin.2fa.show')
            ->with('success', 'Nouveaux codes de récupération générés.');
    }

    /**
     * Générer le QR Code pour Google Authenticator
     */
    private function generateQrCode($user)
    {
        $google2fa = new Google2FA();

        // Générer le secret si ce n'est pas déjà fait
        if (!$user->two_factor_secret) {
            $secret = $google2fa->generateSecretKey();
            
            $user->forceFill([
                'two_factor_secret' => $secret,
            ])->save();
            
            $user->refresh();
        }

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->two_factor_secret
        );

        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=' . urlencode($qrCodeUrl);
    }
}
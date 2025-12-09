<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    /**
     * Afficher le formulaire d'édition du profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    /**
     * Mettre à jour le profil utilisateur
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs,email,' . $user->id_utilisateur . ',id_utilisateur',
        ]);
        
        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
        ]);
        
        return redirect()->route('user.profile.edit')
            ->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    /**
     * Mettre à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Rules\Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();
        
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.profile.edit')
            ->with('success', 'Votre mot de passe a été changé avec succès.');
    }

    /**
     * Mettre à jour l'avatar
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar si existe
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }
            
            // Enregistrer le nouvel avatar
            $filename = 'avatar_' . $user->id_utilisateur . '_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
            $path = $request->file('avatar')->storeAs('avatars', $filename, 'public');
            
            $user->update(['avatar' => $path]);
            
            return redirect()->route('user.profile.edit')
                ->with('success', 'Votre photo de profil a été mise à jour.');
        }

        return redirect()->route('user.profile.edit')
            ->with('error', 'Une erreur est survenue lors du téléchargement.');
    }
}
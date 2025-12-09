<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'prenom' => ['required', 'string', 'max:255'],
        'nom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:utilisateurs'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Trouver le rôle "Utilisateur"
    $roleUtilisateur = Role::where('nom_role', 'Utilisateur')->first();

    if (!$roleUtilisateur) {
        // Si le rôle n'existe pas, créer un rôle par défaut
        $roleUtilisateur = Role::create([
            'nom_role' => 'Utilisateur',
            'description' => 'Utilisateur standard de la plateforme'
        ]);
    }

    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'mot_de_passe' => Hash::make($request->password),
        'id_role' => $roleUtilisateur->id_role,
        'sexe' => 'A',
        'statut' => 'actif',
        'date_inscription' => now(),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/user/dashboard');
}
}
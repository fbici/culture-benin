<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; 
use App\Models\Langue; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['role', 'langue'])->orderBy('id_utilisateur', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Assurez-vous que les tables 'roles' et 'langues' existent et sont remplies.
        $roles = Role::orderBy('nom_role')->pluck('nom_role', 'id_role');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = ['actif' => 'Actif', 'inactif' => 'Inactif', 'suspendu' => 'Suspendu'];

        return view('users.create', compact('roles', 'langues', 'statuts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            // CORRECTION : Validation unique sur la table 'utilisateurs'
            'email' => 'required|string|email|max:255|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:8|confirmed', 
            'id_role' => 'required|exists:roles,id_role',
            'sexe' => ['required', Rule::in(['M', 'F', 'A'])], 
            'id_langue' => 'required|exists:langues,id_langue',
            'date_naissance' => 'nullable|date|before:today',
            'statut' => ['required', Rule::in(['actif', 'inactif', 'suspendu'])],
        ]);

        $data = $request->except('mot_de_passe_confirmation');
        
        $data['date_inscription'] = $data['date_inscription'] ?? now();

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['role', 'langue'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('nom_role')->pluck('nom_role', 'id_role');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = ['actif' => 'Actif', 'inactif' => 'Inactif', 'suspendu' => 'Suspendu'];

        return view('users.edit', compact('user', 'roles', 'langues', 'statuts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            // CORRECTION : Validation unique sur la table 'utilisateurs' en ignorant l'ID actuel
            'email' => 'required|string|email|max:255|unique:utilisateurs,email,' . $id . ',id_utilisateur', 
            'id_role' => 'required|exists:roles,id_role',
            'sexe' => ['required', Rule::in(['M', 'F', 'A'])],
            'id_langue' => 'required|exists:langues,id_langue',
            'date_naissance' => 'nullable|date|before:today',
            'statut' => ['required', Rule::in(['actif', 'inactif', 'suspendu'])],
        ];

        if ($request->filled('mot_de_passe')) {
            $rules['mot_de_passe'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $user = User::findOrFail($id);
        $data = $request->except(['mot_de_passe_confirmation', 'mot_de_passe']);

        if ($request->filled('mot_de_passe')) {
            $data['mot_de_passe'] = $request->mot_de_passe; 
        }
        
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
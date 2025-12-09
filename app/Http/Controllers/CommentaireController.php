<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     * Pourrait être filtré par contenu dans une application réelle.
     */
    public function index()
    {
        $commentaires = Commentaire::with(['utilisateur', 'contenu'])
                                    ->orderBy('id_commentaire', 'desc')
                                    ->paginate(10);
                                    
        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        // CORRECTION : Utiliser selectRaw pour créer la colonne 'nom_complet' à la volée
        $utilisateurs = User::where('statut', 'actif')
                            ->selectRaw('CONCAT(prenom, " ", nom) AS nom_complet, id_utilisateur')
                            ->orderBy('nom')
                            ->pluck('nom_complet', 'id_utilisateur');
                            
        // On conserve la liste des contenus
        $contenus = Contenu::where('statut', 'publie')->pluck('titre', 'id_contenu'); 
        
        return view('commentaires.create', compact('utilisateurs', 'contenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'texte' => 'required|string|max:1000',
            // Note est entre 1 et 5
            'note' => 'nullable|integer|min:1|max:5', 
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'id_contenu' => 'required|exists:contenus,id_contenu',
            'date' => 'nullable|date', // Si on veut pouvoir spécifier une date différente de created_at
        ]);
        
        $validatedData['date'] = $validatedData['date'] ?? now();

        Commentaire::create($validatedData);

        return redirect()->route('commentaires.index')->with('success', 'Commentaire publié avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $commentaire = Commentaire::with(['utilisateur', 'contenu'])->findOrFail($id);
        return view('commentaires.show', compact('commentaire'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        
        // CORRECTION : Utiliser selectRaw ici aussi
        $utilisateurs = User::where('statut', 'actif')
                            ->selectRaw('CONCAT(prenom, " ", nom) AS nom_complet, id_utilisateur')
                            ->orderBy('nom')
                            ->pluck('nom_complet', 'id_utilisateur');
                            
        $contenus = Contenu::where('statut', 'publie')->pluck('titre', 'id_contenu'); 

        return view('commentaires.edit', compact('commentaire', 'utilisateurs', 'contenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'texte' => 'required|string|max:1000',
            'note' => 'nullable|integer|min:1|max:5', 
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'id_contenu' => 'required|exists:contenus,id_contenu',
            'date' => 'nullable|date',
        ]);

        $commentaire = Commentaire::findOrFail($id);
        $commentaire->update($validatedData);

        return redirect()->route('commentaires.index')->with('success', 'Commentaire mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commentaire = Commentaire::findOrFail($id);
        $commentaire->delete();

        return redirect()->route('commentaires.index')->with('success', 'Commentaire supprimé avec succès.');
    }
}
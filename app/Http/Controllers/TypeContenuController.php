<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TypeContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Utilise la clé primaire 'id_type' définie dans le modèle
        $typeContenus = TypeContenu::orderBy('id_type', 'desc')->paginate(10);
        return view('type_contenus.index', compact('typeContenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type_contenus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Validation sur la colonne 'nom'
            'nom' => 'required|string|max:100|unique:type_contenus',
            'description' => 'nullable|string|max:500',
            'icone_css' => 'nullable|string|max:50',
        ]);
        
        $data = $request->all();
        // Génération automatique du slug à partir du champ 'nom'
        $data['slug'] = Str::slug($request->nom);

        TypeContenu::create($data);

        return redirect()->route('type_contenus.index')
                         ->with('success', 'Type de contenu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Recherche sur l'ID (qui est id_type grâce au modèle)
        $typeContenu = TypeContenu::findOrFail($id);
        return view('type_contenus.show', compact('typeContenu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $typeContenu = TypeContenu::findOrFail($id);
        return view('type_contenus.edit', compact('typeContenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // Validation unique : 'nom' dans la table 'type_contenus', ignore l'enregistrement $id en utilisant 'id_type'
            'nom' => 'required|string|max:100|unique:type_contenus,nom,' . $id . ',id_type', 
            'description' => 'nullable|string|max:500',
            'icone_css' => 'nullable|string|max:50',
        ]);

        $typeContenu = TypeContenu::findOrFail($id);
        $data = $request->all();
        // Mise à jour du slug à partir du champ 'nom'
        $data['slug'] = Str::slug($request->nom);

        $typeContenu->update($data);

        return redirect()->route('type_contenus.index')
                         ->with('success', 'Type de contenu mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeContenu = TypeContenu::findOrFail($id);
        $typeContenu->delete();

        return redirect()->route('type_contenus.index')
                         ->with('success', 'Type de contenu supprimé avec succès.');
    }
}
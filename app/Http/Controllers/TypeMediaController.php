<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeMedias = TypeMedia::orderBy('id_type', 'desc')->paginate(10);
        return view('type_medias.index', compact('typeMedias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('type_medias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // La validation vérifie l'unicité sur la colonne 'nom' dans la table 'type_medias'
            'nom' => 'required|string|max:100|unique:type_medias,nom', 
        ]);

        TypeMedia::create($request->all());

        return redirect()->route('type_medias.index')
                         ->with('success', 'Type de média créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        return view('type_medias.show', compact('typeMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        return view('type_medias.edit', compact('typeMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // La validation ignore l'ID actuel pour l'unicité
            'nom' => 'required|string|max:100|unique:type_medias,nom,' . $id . ',id_type', 
        ]);

        $typeMedia = TypeMedia::findOrFail($id);
        $typeMedia->update($request->all());

        return redirect()->route('type_medias.index')
                         ->with('success', 'Type de média mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $typeMedia = TypeMedia::findOrFail($id);
        $typeMedia->delete();

        return redirect()->route('type_medias.index')
                         ->with('success', 'Type de média supprimé avec succès.');
    }
}
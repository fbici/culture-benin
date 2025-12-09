<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\TypeMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::with('typeMedia')->orderBy('id_media', 'desc')->paginate(10);
        return view('medias.index', compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupération des types de médias disponibles
        // ATTENTION : Assurez-vous que la clé primaire de type_medias est bien 'id_type'
        $types = TypeMedia::orderBy('nom')->pluck('nom', 'id_type'); 
        
        return view('medias.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_type_media' => 'required|exists:type_medias,id_type',
            'Chemin' => 'required|string|max:255', // Simplement la validation du chemin pour l'instant
            'description' => 'nullable|string|max:500', 
        ]);

        // NOTE: Ici, la logique d'upload de fichier réel (Storage::put...) devrait se trouver.
        // Pour cet exemple, nous stockons directement le "Chemin" fourni.

        Media::create($request->all());

        return redirect()->route('medias.index')
                         ->with('success', 'Média créé (chemin stocké) avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::with('typeMedia')->findOrFail($id);
        return view('medias.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);
        $types = TypeMedia::orderBy('nom')->pluck('nom', 'id_type');
        
        return view('medias.edit', compact('media', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_type_media' => 'required|exists:type_medias,id_type',
            'Chemin' => 'required|string|max:255', 
            'description' => 'nullable|string|max:500', 
        ]);

        $media = Media::findOrFail($id);
        
        // Si la logique d'upload était implémentée, on gèrerait la suppression de l'ancien fichier ici
        
        $media->update($request->all());

        return redirect()->route('medias.index')
                         ->with('success', 'Média mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        
        // Logique de suppression du fichier physique ici (Storage::delete)
        
        $media->delete();

        return redirect()->route('medias.index')
                         ->with('success', 'Média et son chemin de fichier supprimés avec succès.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserMediaController extends Controller
{
    public function index()
    {
        $medias = Media::with('typeMedia')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $typesMedia = TypeMedia::all(); 

        return view('user.media.index', compact('medias' , 'typesMedia'));
    }

    public function create()
    {
        $types = TypeMedia::all();

         // Récupérer les contenus de l'utilisateur pour lier les médias
        $contenus = Auth::user()->contenus()
            ->whereIn('statut', ['publie', 'en_attente'])
            ->pluck('titre', 'id_contenu');

         $contenus = \App\Models\Contenu::where('id_auteur', Auth::id())
            ->whereIn('statut', ['publie', 'en_attente'])
            ->orderBy('created_at', 'desc')
            ->pluck('titre', 'id_contenu');

        return view('user.media.create', compact('types', 'contenus'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'fichier' => 'required|file|max:51200',
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'id_type_media' => 'required|exists:type_medias,id_type',
        'id_contenu' => 'nullable|exists:contenus,id_contenu',
        'is_premium' => 'nullable|boolean',
        'prix' => 'nullable|numeric|min:0',
        'auteur_original' => 'nullable|string|max:255',
        'copyright' => 'nullable|string|max:255',
        'tags' => 'nullable|string', // Tags séparés par des virgules
    ]);

    if ($request->hasFile('fichier')) {
        $file = $request->file('fichier');
        
        $typeMedia = TypeMedia::find($validatedData['id_type_media']);
        $typeName = strtolower($typeMedia->nom);
        $folder = 'medias/' . $typeName . 's';
        $path = $file->store($folder, 'public');
        
        // Analyser le fichier pour extraire les métadonnées
        $fileInfo = [
            'taille_fichier' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'nom_fichier' => $file->getClientOriginalName(),
        ];
        
        // Pour les images, analyser dimensions
        if (str_starts_with($fileInfo['mime_type'], 'image/')) {
            $imageSize = getimagesize($file->getPathname());
            if ($imageSize) {
                $fileInfo['largeur'] = $imageSize[0];
                $fileInfo['hauteur'] = $imageSize[1];
                $fileInfo['resolution'] = $imageSize[0] . 'x' . $imageSize[1];
            }
        }
        
        // Créer le média avec toutes les métadonnées
        $media = Media::create([
            'Chemin' => $path,
            'titre' => $validatedData['titre'],
            'description' => $validatedData['description'],
            'id_utilisateur' => Auth::id(),
            'id_contenu' => $validatedData['id_contenu'] ?? null,
            'id_type_media' => $validatedData['id_type_media'],
            'nom_fichier' => $fileInfo['nom_fichier'],
            'statut' => 'actif',
            'downloads' => 0,
            'largeur' => $fileInfo['largeur'] ?? null,
            'hauteur' => $fileInfo['hauteur'] ?? null,
            'taille_fichier' => $fileInfo['taille_fichier'],
            'mime_type' => $fileInfo['mime_type'],
            'extension' => $fileInfo['extension'],
            'resolution' => $fileInfo['resolution'] ?? null,
            'is_premium' => $validatedData['is_premium'] ?? false,
            'prix' => $validatedData['prix'] ?? null,
            'auteur_original' => $validatedData['auteur_original'] ?? null,
            'copyright' => $validatedData['copyright'] ?? null,
            'tags' => $validatedData['tags'] ? explode(',', $validatedData['tags']) : [],
            'is_valide' => true,
        ]);

        return redirect()->route('user.medias.index')
            ->with('success', 'Média uploadé avec succès!');
    }

    return back()->with('error', 'Aucun fichier sélectionné.')->withInput();
}

   public function show($id)
{
    $media = Media::where('id_media', $id)
                ->where('id_utilisateur', auth()->id())
                ->with('typeMedia')
                ->firstOrFail();
    
    return view('user.media.show', compact('media'));
}

 public function edit($id)
    {
        $media = Media::where('id_media', $id)
                    ->where('id_utilisateur', Auth::id())
                    ->firstOrFail();
        
        $typeMedia = TypeMedia::all();
        
        return view('user.media.edit', compact('media', 'typeMedia'));
    }

    public function destroy($id)
    {
        $media = Media::where('id_utilisateur', Auth::id())->findOrFail($id);
        
        // Supprimer le fichier physique
        Storage::delete('public/' . $media->Chemin);
        
        // Supprimer l'enregistrement de la base de données
        $media->delete();

        return redirect()->route('user.medias.index')
            ->with('success', 'Média supprimé avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Récupérer le média
        $media = Media::where('id_media', $id)
                      ->where('id_utilisateur', Auth::id())
                      ->firstOrFail();

        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'id_type_media' => 'required|exists:type_medias,id_type_media',
            'is_premium' => 'boolean',
            'prix' => 'nullable|numeric|min:0',
            'auteur_original' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        // Mettre à jour le média
        $media->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'id_type_media' => $validated['id_type_media'],
            'is_premium' => $request->has('is_premium') ? $request->boolean('is_premium') : $media->is_premium,
            'prix' => $request->has('is_premium') && $request->boolean('is_premium') ? $validated['prix'] : null,
            'auteur_original' => $validated['auteur_original'] ?? null,
            'copyright' => $validated['copyright'] ?? null,
            'tags' => $validated['tags'] ?? null,
        ]);

        // Redirection avec message de succès
        return redirect()->route('user.medias.show', $media->id_media)
                         ->with('success', 'Média mis à jour avec succès!');
    }
}
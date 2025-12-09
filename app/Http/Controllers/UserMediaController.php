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
    // Règles de validation
    $validatedData = $request->validate([
        'fichier' => 'required|file|max:51200',
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'id_type_media' => 'required|exists:type_medias,id_type',
        'id_contenu' => 'nullable|exists:contenus,id_contenu',
    ]);

    // Gérer l'upload du fichier
    if ($request->hasFile('fichier')) {
        try {
            $file = $request->file('fichier');
            
            // Déterminer le chemin de stockage selon le type de média
            $typeMedia = TypeMedia::find($validatedData['id_type_media']);
            
            if (!$typeMedia) {
                return back()->with('error', 'Type de média non trouvé.')
                    ->withInput();
            }
            
            $typeName = strtolower($typeMedia->nom ?? 'other');
            
            $folder = 'medias/' . $typeName . 's';
            $path = $file->store($folder, 'public');
            
            // Créer le média
            $media = Media::create([
                'Chemin' => $path,
                'description' => $validatedData['description'],
                'id_utilisateur' => Auth::id(),
                'id_contenu' => $validatedData['id_contenu'] ?? null,
                'id_type_media' => $validatedData['id_type_media'],
                'nom_fichier' => $file->getClientOriginalName(),
                'statut' => 'actif',
                'downloads' => 0,
            ]);

            return redirect()->route('user.medias.index')
                ->with('success', 'Média uploadé avec succès!');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'upload: ' . $e->getMessage())
                ->withInput();
        }
    }

    return back()->with('error', 'Aucun fichier sélectionné.')
        ->withInput();
}

    public function show($id)
    {
         $media = Media::with(['typeMedia', 'user', 'contenu'])
            ->where('id_utilisateur', Auth::id())
            ->findOrFail($id);

        return view('user.medias.show', compact('media'));
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
}
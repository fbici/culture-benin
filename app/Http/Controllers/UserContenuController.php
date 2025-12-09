<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\Media;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserContenuController extends Controller
{
    public function index()
    {
        $contenus = Contenu::with(['typeContenu', 'region', 'langue'])
            ->where('id_auteur', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $statuts = $this->getStatutOptions();

        return view('user.contenus.index', compact('contenus', 'statuts'));
    }

    public function create()
    {
        $types = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();
        $statuts = $this->getStatutOptions();
        
        // Les utilisateurs ne peuvent choisir que leurs propres contenus comme parents
        $parents = Contenu::where('id_auteur', Auth::id())
                         ->where('statut', 'publie')
                         ->pluck('titre', 'id_contenu');

        return view('user.contenus.create', compact('types', 'regions', 'langues', 'statuts', 'parents'));
    }

    public function store(Request $request)
    {
        // Règles de validation avec médias
        $validatedData = $request->validate(array_merge($this->validationRules(), [
            // Règles pour les médias
            'image_principale' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:5120',
            'audio' => 'nullable|mimes:mp3,wav|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]));

        // L'auteur est automatiquement l'utilisateur connecté
        $validatedData['id_auteur'] = Auth::id();
        $validatedData['date_creation'] = $validatedData['date_creation'] ?? now();
        
        // Les utilisateurs normaux ne peuvent pas publier directement
        if ($validatedData['statut'] === 'publie') {
            $validatedData['statut'] = 'en_attente'; // Doit être modéré
        }

        // Créer le contenu
        $contenu = Contenu::create($validatedData);

        // Gérer l'upload des médias
        $this->handleMediaUpload($request, $contenu);

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu créé avec succès. Il sera publié après modération.');
    }

    public function show($id)
    {
        $contenu = Contenu::with(['typeContenu', 'region', 'langue', 'parent', 'medias.typeMedia'])
            ->where('id_auteur', Auth::id())
            ->findOrFail($id);
            
        $statuts = $this->getStatutOptions();

        return view('user.contenus.show', compact('contenu', 'statuts'));
    }

    public function edit($id)
    {
        $contenu = Contenu::with('medias')->where('id_auteur', Auth::id())->findOrFail($id);
        
        $types = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();
        $statuts = $this->getStatutOptions();
        
        $parents = Contenu::where('id_auteur', Auth::id())
                         ->where('statut', 'publie')
                         ->where('id_contenu', '!=', $id)
                         ->pluck('titre', 'id_contenu');

        return view('user.contenus.edit', compact('contenu', 'types', 'regions', 'langues', 'statuts', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        
        $validatedData = $request->validate(array_merge($this->validationRules($id), [
            // Règles pour les médias
            'image_principale' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:5120',
            'audio' => 'nullable|mimes:mp3,wav|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]));
        
        // Si le statut passe à "publié", il doit être modéré
        if ($validatedData['statut'] === 'publie' && $contenu->statut !== 'publie') {
            $validatedData['statut'] = 'en_attente';
        }

        $contenu->update($validatedData);

        // Gérer l'upload des médias
        $this->handleMediaUpload($request, $contenu);

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $contenu = Contenu::where('id_auteur', Auth::id())->findOrFail($id);
        
        // Supprimer les médias associés
        foreach ($contenu->medias as $media) {
            Storage::delete('public/' . $media->Chemin);
            $media->delete();
        }
        
        $contenu->delete();

        return redirect()->route('user.contenus.index')
                         ->with('success', 'Contenu supprimé avec succès.');
    }

    /**
     * Gère l'upload des médias pour un contenu
     */
    private function handleMediaUpload(Request $request, Contenu $contenu)
    {
        // Traiter l'image principale
        if ($request->hasFile('image_principale')) {
            $this->uploadMedia($request->file('image_principale'), $contenu, 'Image', 'Image principale pour: ' . $contenu->titre);
        }

        // Traiter les images multiples
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $this->uploadMedia($image, $contenu, 'Image', 'Image supplémentaire pour: ' . $contenu->titre);
            }
        }

        // Traiter la vidéo
        if ($request->hasFile('video')) {
            $this->uploadMedia($request->file('video'), $contenu, 'Vidéo', 'Vidéo pour: ' . $contenu->titre);
        }

        // Traiter l'audio
        if ($request->hasFile('audio')) {
            $this->uploadMedia($request->file('audio'), $contenu, 'Audio', 'Audio pour: ' . $contenu->titre);
        }

        // Traiter le document
        if ($request->hasFile('document')) {
            $this->uploadMedia($request->file('document'), $contenu, 'Document', 'Document pour: ' . $contenu->titre);
        }
    }

    /**
     * Fonction utilitaire pour uploader un média
     */
    private function uploadMedia($file, $contenu, $typeMediaName, $description)
    {
        // Trouver l'ID du type de média
        $typeMedia = TypeMedia::where('nom', $typeMediaName)->first();
        
        if (!$typeMedia) {
            return;
        }

        // Déterminer le chemin de stockage selon le type
        $folder = 'medias/' . strtolower($typeMediaName) . 's';
        $path = $file->store($folder, 'public');

        // Créer l'enregistrement du média
        Media::create([
            'Chemin' => $path,
            'description' => $description,
            'id_utilisateur' => Auth::id(),
            'id_contenu' => $contenu->id_contenu,
            'id_type_media' => $typeMedia->id_type_media,
            'nom_fichier' => $file->getClientOriginalName(),
            'statut' => 'actif',
        ]);
    }

    protected function getStatutOptions()
    {
        return [
            'brouillon' => ['label' => 'Brouillon', 'badge' => 'bg-secondary'],
            'en_attente' => ['label' => 'En Attente de Modération', 'badge' => 'bg-warning text-dark'],
            'publie' => ['label' => 'Publié', 'badge' => 'bg-success'],
            'rejete' => ['label' => 'Rejeté', 'badge' => 'bg-danger'],
        ];
    }

    protected function validationRules($id = null)
    {
        return [
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_parent' => 'nullable|exists:contenus,id_contenu',
            'texte' => 'required|string',
            'date_creation' => 'nullable|date',
            'statut' => ['required', Rule::in(['brouillon', 'en_attente'])],
        ];
    }
}
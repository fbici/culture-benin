<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\User;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Chargement des relations nécessaires pour l'affichage dans l'index
        $contenus = Contenu::with(['typeContenu', 'auteur', 'langue'])
                            ->orderBy('id_contenu', 'desc')
                            ->paginate(10);
                            
        $statuts = $this->getStatutOptions(); // Pour l'affichage des badges

        return view('contenus.index', compact('contenus', 'statuts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Préparation des données pour les listes déroulantes
        $types = TypeContenu::orderBy('nom')->pluck('nom', 'id_type');
        $auteurs = User::where('statut', 'actif')->pluck('nom', 'id_utilisateur');
        $regions = Region::orderBy('nom_region')->pluck('nom_region', 'id_region');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = $this->getStatutOptions();
        
        // Contenus existants pour la liste des parents (si applicable, ex: traductions)
        $parents = Contenu::where('statut', 'publie')->pluck('titre', 'id_contenu');

        return view('contenus.create', compact('types', 'auteurs', 'regions', 'langues', 'statuts', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        // Gérer le statut et les dates de validation
        $validatedData['date_creation'] = $validatedData['date_creation'] ?? now();
        $validatedData['statut'] = $validatedData['statut'] ?? 'brouillon'; // Par défaut : Brouillon

        // Si le contenu est publié, définir la date de validation
        if ($validatedData['statut'] === 'publie' && !$request->filled('date_validation')) {
            $validatedData['date_validation'] = now();
        }
        
        // Le modérateur n'est généralement pas défini à la création, sauf si c'est un Admin qui publie directement
        
        Contenu::create($validatedData);

        return redirect()->route('contenus.index')->with('success', 'Contenu créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contenu = Contenu::with(['typeContenu', 'auteur', 'region', 'langue', 'moderateur', 'parent', 'enfants'])
                          ->findOrFail($id);
        
        $statuts = $this->getStatutOptions();
                          
        return view('contenus.show', compact('contenu', 'statuts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contenu = Contenu::findOrFail($id);
               
        $types = TypeContenu::orderBy('nom')->pluck('nom', 'id_type');
        $auteurs = User::where('statut', 'actif')->pluck('nom', 'id_utilisateur');
        $regions = Region::orderBy('nom_region')->pluck('nom_region', 'id_region');
        $langues = Langue::orderBy('nom_langue')->pluck('nom_langue', 'id_langue');
        $statuts = $this->getStatutOptions();
        
        // Exclure le contenu actuel de la liste des parents pour éviter les boucles infinies
        $parents = Contenu::where('statut', 'publie')
                            ->where('id_contenu', '!=', $id)
                            ->pluck('titre', 'id_contenu');

        return view('contenus.edit', compact('contenu', 'types', 'auteurs', 'regions', 'langues', 'statuts', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate($this->validationRules($id));
        $contenu = Contenu::findOrFail($id);
        
        // Gestion de la date de validation (si le statut passe à 'publie' et qu'il n'y a pas de date existante)
        if ($validatedData['statut'] === 'publie' && empty($contenu->date_validation)) {
             $validatedData['date_validation'] = now();
        }
        
        // Si le contenu est annulé, on retire la date de validation
        if ($validatedData['statut'] !== 'publie') {
             $validatedData['date_validation'] = null;
        }

        $contenu->update($validatedData);

        return redirect()->route('contenus.index')->with('success', 'Contenu mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contenu = Contenu::findOrFail($id);
        $contenu->delete();

        return redirect()->route('contenus.index')->with('success', 'Contenu supprimé avec succès.');
    }
    
    // --- Fonctions utilitaires ---
    
    protected function getStatutOptions()
    {
        return [
            'brouillon' => ['label' => 'Brouillon', 'badge' => 'bg-secondary'],
            'en_attente' => ['label' => 'En Attente', 'badge' => 'bg-warning text-dark'],
            'publie' => ['label' => 'Publié', 'badge' => 'bg-success'],
            'rejete' => ['label' => 'Rejeté', 'badge' => 'bg-danger'],
        ];
    }
    
    protected function validationRules($id = null)
    {
        return [
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenus,id_type',
            'id_auteur' => 'required|exists:utilisateurs,id_utilisateur',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_parent' => 'nullable|exists:contenus,id_contenu', // Peut être nul
            // id_moderateur ne doit être rempli que par l'admin à la validation
            'id_moderateur' => 'nullable|exists:utilisateurs,id_utilisateur', 
            'texte' => 'required|string',
            'date_creation' => 'nullable|date',
            // Valider que le statut est dans la liste des options
            'statut' => ['required', Rule::in(array_keys($this->getStatutOptions()))],
            'date_validation' => 'nullable|date',
        ];
    }
}
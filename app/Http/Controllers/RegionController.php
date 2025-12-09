<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;



class RegionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pagination par 10 éléments et tri par ID descendant
        $regions = Region::orderBy('id_region', 'desc')->get(); 
        
        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:100|unique:regions',
            'description' => 'nullable|string|max:500',
            'population' => 'nullable|integer|min:0',
            'superficie' => 'nullable|numeric|min:0',
            'localisation' => 'nullable|string|max:255',
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')
                         ->with('success', 'Région créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $region = Region::findOrFail($id);
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // Validation unique, ignore la région actuelle par id_region
            'nom_region' => 'required|string|max:100|unique:regions,nom_region,' . $id . ',id_region',
            'description' => 'nullable|string|max:500',
            'population' => 'nullable|integer|min:0',
            'superficie' => 'nullable|numeric|min:0',
            'localisation' => 'nullable|string|max:255',
        ]);

        $region = Region::findOrFail($id);
        $region->update($request->all());

        return redirect()->route('regions.index')
                         ->with('success', 'Région mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   

        if (Gate::denies('delete')) {
            abort(403, 'Seul un Administrateur peut supprimer des données.');
        }
        
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('regions.index')->with('success', 'Région supprimée avec succès.');

    
        $region = Region::findOrFail($id);

        // Optionnel : Ajouter ici une vérification si la région est utilisée par d'autres entités

        $region->delete();

        return redirect()->route('regions.index')
                         ->with('success', 'Région supprimée avec succès.');
    }
}
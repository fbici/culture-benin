<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langues = Langue::orderBy('id_langue', 'desc')->paginate(10);
        return view('langues.index', compact('langues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_langue' => 'required|string|max:3|unique:langues', // Changé 'langue' en 'langues'
            'nom_langue' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Langue::create($request->all());

        return redirect()->route('langues.index')
                         ->with('success', 'Langue créée avec succès.');
    }

        /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $langue = Langue::findOrFail($id);
        return view('langues.show', compact('langue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langue = Langue::findOrFail($id);
        return view('langues.edit', compact('langue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code_langue' => 'required|string|max:3|unique:langues,code_langue,' . $id . ',id_langue', // Changé 'langue' en 'langues'
            'nom_langue' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $langue = Langue::findOrFail($id);
        $langue->update($request->all());

        return redirect()->route('langues.index')
                         ->with('success', 'Langue mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $langue = Langue::findOrFail($id);
        $langue->delete();

        return redirect()->route('langues.index')
                         ->with('success', 'Langue supprimée avec succès.');
    }
}
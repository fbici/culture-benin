<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class PublicLangueController extends Controller
{
    public function index(Request $request)
    {
        $query = Langue::query();
        
        // Recherche
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_langue', 'LIKE', "%{$search}%")
                  ->orWhere('code_langue', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        // Tri
        if ($request->has('sort')) {
            switch($request->sort) {
                case 'name_desc':
                    $query->orderBy('nom_langue', 'desc');
                    break;
                case 'code_asc':
                    $query->orderBy('code_langue', 'asc');
                    break;
                case 'code_desc':
                    $query->orderBy('code_langue', 'desc');
                    break;
                default:
                    $query->orderBy('nom_langue', 'asc');
            }
        } else {
            $query->orderBy('nom_langue', 'asc');
        }
        
        // Pagination
        $langues = $query->paginate(12);
        $totalLangues = Langue::count();
        
        return view('langue.index', compact('langues', 'totalLangues'));
    }
    
    public function show($id)
    {
        $langue = Langue::findOrFail($id);
        
        // Récupérer les contenus dans cette langue
        $contenus = $langue->contenus()->where('statut', 'publié')->take(6)->get();
        
        return view('langue.show', compact('langue', 'contenus'));
    }
}
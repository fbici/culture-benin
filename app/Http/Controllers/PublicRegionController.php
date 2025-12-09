<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class PublicRegionController extends Controller
{
    public function index(Request $request)
    {
        $query = Region::query();
        
        // Recherche
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom_region', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('localisation', 'LIKE', "%{$search}%");
            });
        }
        
        // Tri
        if ($request->has('sort')) {
            switch($request->sort) {
                case 'population_desc':
                    $query->orderBy('population', 'desc');
                    break;
                case 'population_asc':
                    $query->orderBy('population', 'asc');
                    break;
                case 'area_desc':
                    $query->orderBy('superficie', 'desc');
                    break;
                case 'area_asc':
                    $query->orderBy('superficie', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('nom_region', 'desc');
                    break;
                default:
                    $query->orderBy('nom_region', 'asc');
            }
        } else {
            $query->orderBy('nom_region', 'asc');
        }
        
        // Pagination
        $regions = $query->paginate(9);
        
        // Statistiques
        $totalRegions = Region::count();
        $totalPopulation = Region::sum('population');
        $totalArea = Region::sum('superficie');
        $avgPopulation = Region::avg('population');
        
        return view('region.index', compact('regions', 'totalRegions', 'totalPopulation', 'totalArea', 'avgPopulation'));
    }
    
    public function show($id)
    {
        $region = Region::findOrFail($id);
        
        // Récupérer les contenus de cette région
        $contenus = $region->contenus()->where('statut', 'publié')->take(6)->get();
        
        return view('region.show', compact('region', 'contenus'));
    }
}
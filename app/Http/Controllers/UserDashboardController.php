<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\Media;
use App\Models\Commentaire;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'contenus' => Contenu::where('id_auteur', $user->id_utilisateur)->count(),
            'medias' => Media::where('id_utilisateur', $user->id_utilisateur)->count(),
            'commentaires' => Commentaire::where('id_utilisateur', $user->id_utilisateur)->count(),
        ];

        $contenusRecents = Contenu::where('id_auteur', $user->id_utilisateur)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'contenusRecents'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\TypeMedia;
use App\Models\Achat;
use App\Services\FedapayService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PublicMediaController extends Controller
{
    protected $fedapayService;

    public function __construct(FedapayService $fedapayService)
    {
        $this->fedapayService = $fedapayService;
        $this->middleware('auth')->only(['initiatePayment', 'download']);
    }

    public function index(Request $request)
    {
        $query = Media::with('typeMedia', 'user')
            ->orderBy('created_at', 'desc');

        if ($request->type) {
            $query->where('id_type_media', $request->type);
        }

        if ($request->search) {
            $query->where('description', 'like', '%' . $request->search . '%')
                  ->orWhere('Chemin', 'like', '%' . $request->search . '%');
        }

        $medias = $query->paginate(20);
        $types = TypeMedia::all();

        return view('media.index', compact('medias', 'types'));
    }

    public function show($id)
    {
        $media = Media::with('typeMedia', 'user')
            ->findOrFail($id);


        // Déterminer le prix selon le type de média
        $prices = [
            'Vidéo' => 500,
            'Image' => 150,
            'Audio' => 100,
            'PDF' => 100,
            'Document' => 100
        ];
        
        $price = $prices[$media->typeMedia->nom] ?? 500;
        
        // Vérifier si l'utilisateur a accès au téléchargement
        $canDownload = false;
        $user = auth()->user();
        
        if ($user) {
            $achat = Achat::where('id_utilisateur', $user->id_utilisateur) // CHANGEZ ICI
                ->where('type_item', 'media')
                ->where('id_item', $media->id_media)
                ->where('statut', 'complété')
                ->exists();
            
            $canDownload = $achat;
        }

        // Récupérer les médias similaires
        $similarMedias = Media::with('typeMedia')
            ->where('id_type_media', $media->id_type_media)
            ->where('id_media', '!=', $media->id_media)
            ->where(function($query) use ($media) {
                // Optionnel: ajouter des critères de similarité supplémentaires
                $query->where('description', 'like', '%' . $media->description . '%')
                    ->orWhere('description', 'like', '%' . substr($media->description, 0, 20) . '%');
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Si pas assez de résultats avec la description, prendre d'autres médias du même type
        if ($similarMedias->count() < 3) {
            $additionalMedias = Media::with('typeMedia')
                ->where('id_type_media', $media->id_type_media)
                ->where('id_media', '!=', $media->id_media)
                ->whereNotIn('id_media', $similarMedias->pluck('id_media'))
                ->inRandomOrder()
                ->limit(4 - $similarMedias->count())
                ->get();
            
            $similarMedias = $similarMedias->merge($additionalMedias);
        }

        return view('media.show', compact('media', 'canDownload', 'similarMedias'));
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'media_id' => 'required|exists:medias,id_media',
        ]);

        $user = auth()->user();
        $media = Media::with('typeMedia')->findOrFail($request->media_id);

        // Prix selon le type de média
        $prices = [
            'Vidéo' => 500,
            'Image' => 150,
            'Audio' => 100,
            'PDF' => 100,
            'Document' => 100
        ];
        
        $price = $prices[$media->typeMedia->nom] ?? 500;

        // Vérifier si l'utilisateur a déjà acheté
         $achatExistant = Achat::where('id_utilisateur', $user->id_utilisateur) // CHANGEZ ICI
            ->where('type_item', 'media')
            ->where('id_item', $media->id_media)
            ->where('statut', 'complété')
            ->exists();

        if ($achatExistant) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà acheté ce média.',
            ]);
        }

        // Créer un enregistrement d'achat
        $achat = Achat::create([
            'id_utilisateur' => $user->id_utilisateur, // Note: utilisez id_utilisateur
            'type_item' => 'media',
            'id_item' => $media->id_media,
            'montant' => $price, // Prix dynamique
            'devise' => 'FCFA',
            'statut' => 'en_attente',
            'reference_paiement' => 'MEDIA-' . time() . '-' . $user->id_utilisateur, // CHANGEZ ICI
        ]);

        // Créer la transaction FEDAPAY
        $result = $this->fedapayService->creerTransaction(
            $price, // Montant dynamique
            "Téléchargement du média: {$media->description}",
            $user,
            route('payment.callback', ['reference' => $achat->reference_paiement, 'type' => 'media'])
        );

        if ($result['success']) {
            $achat->update(['transaction_id' => $result['transaction']->id]);

            return response()->json([
                'success' => true,
                'message' => 'Paiement initié',
                'payment_url' => $result['payment_url'],
                'reference' => $achat->reference_paiement,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'initialisation du paiement: ' . ($result['error'] ?? 'Erreur inconnue'),
        ], 500);
    }

     public function download($id)
    {
        $media = Media::where('id_media', $id)
                    ->where('is_valide', true)
                    ->firstOrFail();
        
        // Vérifier les droits d'accès pour les médias premium
        if ($media->is_premium && !auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour télécharger ce média premium.');
        }
        
        // Vérifier si l'utilisateur a acheté le média premium
        if ($media->is_premium && auth()->check() && !auth()->user()->is_admin) {
            // Ici, vous devriez vérifier si l'utilisateur a acheté ce média
            // Pour l'instant, on autorise tous les utilisateurs connectés
            // À implémenter : vérification d'achat
        }
        
        // Vérifier si le fichier existe
        $path = 'public/' . $media->Chemin;
        if (!Storage::exists($path)) {
            return back()->with('error', 'Le fichier n\'existe plus sur le serveur.');
        }
        
        // Incrémenter le compteur de téléchargements
        $media->increment('downloads');
        
        // Télécharger le fichier
        return Storage::download($path, $media->nom_fichier ?? basename($media->Chemin));
    }


    public function checkAccess($id)
    {
        $media = Media::findOrFail($id);
        $user = auth()->user();
        $hasAccess = false;

        if ($user) {
            $achat = Achat::where('id_utilisateur', $user->id_utilisateur) // CHANGEZ ICI
                ->where('type_item', 'media')
                ->where('id_item', $media->id_media)
                ->where('statut', 'complété')
                ->exists();
            
            $hasAccess = $achat;
        }

        return response()->json([
            'has_access' => $hasAccess,
            'media' => [
                'id' => $media->id_media,
                'description' => $media->description,
                'type' => $media->typeMedia->nom ?? 'Média',
            ],
        ]);
    }
}
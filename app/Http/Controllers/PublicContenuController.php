<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;

use App\Services\FedapayService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Achat;

class PublicContenuController extends Controller
{
    protected $fedapayService;

    public function __construct(FedapayService $fedapayService)
    {
        $this->fedapayService = $fedapayService;
        $this->middleware('auth')->only(['initiatePayment', 'checkAccess']);
    }

    public function index(Request $request)
    {
        $query = Contenu::where('statut', 'publié')
            ->with(['typeContenu', 'region', 'langue', 'auteur'])
            ->orderBy('created_at', 'desc');

        if ($request->type) {
            $query->where('id_type_contenu', $request->type);
        }
        
        if ($request->region) {
            $query->where('id_region', $request->region);
        }
        
        if ($request->langue) {
            $query->where('id_langue', $request->langue);
        }

        $contenus = $query->paginate(12);
        $types = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();

        return view('contenu.index', compact('contenus', 'types', 'regions', 'langues'));
    }

    public function show($id)
{
    $contenu = Contenu::with([
        'typeContenu',
        'region',
        'langue',
        'auteur' => function($query) {
            $query->withCount('contenus');
        }
    ])->findOrFail($id);
    
    // Vérifier si l'utilisateur a accès
    $hasAccess = false;
    $user = auth()->user();
    
    if ($user) {
        // 1. Vérifier si l'utilisateur est l'auteur
        if ($user->id_utilisateur == $contenu->id_auteur) {
            $hasAccess = true;
        }
        // 2. Vérifier si l'utilisateur a acheté le contenu
        else {
            $achat = Achat::where('id_utilisateur', $user->id_utilisateur)
                ->where('type_item', 'contenu')
                ->where('id_item', $contenu->id_contenu)
                ->where('statut', 'complété')
                ->exists();
            
            $hasAccess = $achat;
        }
    }

    return view('contenu.show', compact('contenu', 'hasAccess'));
}

    public function initiatePayment(Request $request)
{
    \Log::info('=== DÉBUT INITIALISATION PAIEMENT ===');
    \Log::info('Données reçues:', $request->all());
    \Log::info('Utilisateur:', auth()->user() ? ['id' => auth()->user()->id_utilisateur, 'email' => auth()->user()->email] : 'Non authentifié');

    try {
        $request->validate([
            'contenu_id' => 'required|exists:contenus,id_contenu',
        ]);
        
        \Log::info('Validation réussie');

        $user = auth()->user();
        $contenu = Contenu::findOrFail($request->contenu_id);
        
        \Log::info('Contenu trouvé:', ['id' => $contenu->id_contenu, 'titre' => $contenu->titre]);

        // Vérifier si l'utilisateur a déjà acheté
        $achatExistant = Achat::where('id_utilisateur', $user->id_utilisateur)
            ->where('type_item', 'contenu')
            ->where('id_item', $contenu->id_contenu)
            ->where('statut', 'complété')
            ->exists();

        \Log::info('Achat existant?', ['existe' => $achatExistant]);

        if ($achatExistant) {
            \Log::warning('Utilisateur a déjà acheté ce contenu');
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà acheté ce contenu.',
            ]);
        }

        // Créer un enregistrement d'achat
        $reference = 'CONT-' . time() . '-' . $user->id_utilisateur;
        \Log::info('Création achat avec référence:', ['reference' => $reference]);
        
        $achat = Achat::create([
            'id_utilisateur' => $user->id_utilisateur,
            'type_item' => 'contenu',
            'id_item' => $contenu->id_contenu,
            'montant' => 100,
            'devise' => 'FCFA',
            'statut' => 'en_attente',
            'reference_paiement' => $reference,
        ]);

        \Log::info('Achat créé:', ['achat_id' => $achat->id_achat]);

        // Créer la transaction FEDAPAY
        \Log::info('Appel FEDAPAY Service');
        $result = $this->fedapayService->creerTransaction(
            100,
            "Lecture du contenu: {$contenu->titre}",
            $user,
            route('payment.callback', ['reference' => $achat->reference_paiement, 'type' => 'contenu'])
        );

        \Log::info('Résultat FEDAPAY:', $result);

        if ($result['success']) {
            // Sauvegarder l'ID de transaction
            $achat->update(['transaction_id' => $result['transaction']->id]);
            
            \Log::info('Transaction FEDAPAY sauvegardée', ['transaction_id' => $result['transaction']->id]);

            return response()->json([
                'success' => true,
                'message' => 'Paiement initié',
                'payment_url' => $result['payment_url'],
                'reference' => $achat->reference_paiement,
            ]);
        }

        \Log::error('FEDAPAY a échoué', ['error' => $result['error'] ?? 'Erreur inconnue']);
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de l\'initialisation du paiement: ' . ($result['error'] ?? 'Erreur inconnue'),
        ], 500);

    } catch (\Exception $e) {
        \Log::error('Exception dans initiatePayment:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Erreur serveur: ' . $e->getMessage(),
        ], 500);
    }
}

    public function paymentCallback(Request $request)
    {
        $request->validate([
            'reference' => 'required',
            'type' => 'required|in:contenu,media',
        ]);

        $achat = Achat::where('reference_paiement', $request->reference)->first();

        if (!$achat) {
            return redirect()->route('contenus.index')
                ->with('error', 'Transaction non trouvée.');
        }

        // Vérifier le statut avec FEDAPAY
        if ($achat->transaction_id) {
            $result = $this->fedapayService->verifierTransaction($achat->transaction_id);
            
            if ($result['success'] && $result['status'] == 'approved') {
                $achat->update([
                    'statut' => 'complété',
                    'date_paiement' => Carbon::now(),
                ]);

                $message = $request->type == 'contenu' 
                    ? 'Paiement réussi ! Vous avez maintenant accès au contenu complet.'
                    : 'Paiement réussi ! Vous pouvez maintenant télécharger le média.';

                return redirect()->route($request->type == 'contenu' ? 'contenus.show' : 'medias.index', 
                    $request->type == 'contenu' ? $achat->id_item : null)
                    ->with('success', $message);
            }
        }

        // Si pas de vérification FEDAPAY, marquer comme échoué
        $achat->update(['statut' => 'échoué']);

        return redirect()->route('contenus.index')
            ->with('error', 'Le paiement a échoué.');
    }

    public function checkAccess($id)
    {
        $contenu = Contenu::findOrFail($id);
        $user = auth()->user();
        $hasAccess = false;

        if ($user) {
            // Vérifier les accès
            if ($user->id_utilisateur == $contenu->id_auteur) { 
                $hasAccess = true;
            } else {
                $achat = Achat::where('id_utilisateur', $user->id_utilisateur) // CHANGEZ id en id_utilisateur
                ->where('type_item', 'contenu')
                ->where('id_item', $contenu->id_contenu)
                ->where('statut', 'complété')
                ->exists();
            }
        }

        return response()->json([
            'has_access' => $hasAccess,
            'contenu' => [
                'id' => $contenu->id_contenu,
                'titre' => $contenu->titre,
                'type' => $contenu->typeContenu->nom_type ?? 'Article',
            ],
        ]);
    }
}
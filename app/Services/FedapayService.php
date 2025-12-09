<?php

namespace App\Services;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use FedaPay\Customer;
use Exception;
use Illuminate\Support\Facades\Log;

class FedapayService
{
    public function __construct()
    {
        \Log::info('Initialisation FEDAPAY', [
            'api_key' => config('services.fedapay.api_key'),
            'environment' => config('services.fedapay.environment')
        ]);
        
        try {
            FedaPay::setApiKey(config('services.fedapay.api_key'));
            FedaPay::setEnvironment(config('services.fedapay.environment'));
            \Log::info('FEDAPAY initialisé avec succès');
        } catch (Exception $e) {
            \Log::error('Erreur initialisation FEDAPAY: ' . $e->getMessage());
        }
    }

    public function creerTransaction($montant, $description, $user, $callbackUrl)
    {
        \Log::info('=== CRÉATION TRANSACTION FEDAPAY ===');
        \Log::info('Montant:', ['montant' => $montant]);
        \Log::info('Description:', ['description' => $description]);
        \Log::info('User:', ['user_id' => $user->id_utilisateur, 'email' => $user->email]);
        \Log::info('Callback URL:', ['url' => $callbackUrl]);

        try {
            // Vérifier la configuration
            if (!config('services.fedapay.api_key')) {
                throw new Exception('Clé API FEDAPAY non configurée');
            }

            // Créer ou récupérer le client
            $customer = Customer::create([
                'firstname' => $user->prenom ?? 'Client',
                'lastname' => $user->nom ?? 'Anonyme',
                'email' => $user->email,
                'phone_number' => $user->telephone ?? '00000000',
            ]);

            \Log::info('Client FEDAPAY créé:', ['customer_id' => $customer->id]);

            // Créer la transaction
            $transaction = Transaction::create([
                'description' => $description,
                'amount' => $montant,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => $callbackUrl,
                'customer' => $customer->id,
            ]);

            \Log::info('Transaction FEDAPAY créée:', ['transaction_id' => $transaction->id]);

            // Générer le token de paiement
            $token = $transaction->generateToken();
            
            \Log::info('Token généré:', ['token' => $token->token]);

            return [
                'success' => true,
                'transaction' => $transaction,
                'payment_url' => "https://sandbox.fedapay.com/pay/{$token->token}",
            ];

        } catch (Exception $e) {
            \Log::error('Erreur FEDAPAY détaillée:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
}
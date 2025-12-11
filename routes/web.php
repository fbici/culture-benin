<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PublicContenuController;
use App\Http\Controllers\PublicMediaController;
use App\Http\Controllers\UserContenuController;
use App\Http\Controllers\UserMediaController;
use App\Http\Controllers\PublicRegionController;
use App\Http\Controllers\PublicLangueController;
use App\Http\Controllers\UserProfileController;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
})->name('accueil');


// Avant la ligne require __DIR__.'/auth.php';
Route::get('/contenus', [PublicContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/{id}', [PublicContenuController::class, 'show'])->name('contenus.show');
Route::get('/medias', [PublicMediaController::class, 'index'])->name('media.index');
Route::get('/medias/{id}', [PublicMediaController::class, 'show'])->name('media.show');
Route::get('/{id}/download', [PublicMediaController::class, 'download'])->name('medias.download');

// Route temporaire (retourne toujours un succès pour les tests)
Route::post('/contenus/{id}/bookmark', function($id) {
    return response()->json([
        'success' => true,
        'message' => 'Fonctionnalité en développement'
    ]);
})->name('contenus.bookmark')->middleware('auth');



// Routes authentifiées pour paiement
Route::middleware(['auth'])->group(function () {
    // Paiement contenu
    Route::post('/contenu/paiement', [PublicContenuController::class, 'initiatePayment'])->name('contenu.payment.initiate');
    Route::get('/contenu/{id}/check-access', [PublicContenuController::class, 'checkAccess'])->name('contenu.checkAccess');
    
    // Paiement média
    Route::post('/media/paiement', [PublicMediaController::class, 'initiatePayment'])->name('media.payment.initiate');
    Route::get('/media/{id}/download', [PublicMediaController::class, 'download'])->name('media.download');
    Route::get('/media/{id}/check-access', [PublicMediaController::class, 'checkAccess'])->name('media.checkAccess');
    
    // Callback de paiement (commun)
    Route::get('/paiement/callback', [PublicContenuController::class, 'paymentCallback'])->name('payment.callback');
});

// Webhook FEDAPAY (accessible sans authentification)
Route::post('/webhook/fedapay', [PublicContenuController::class, 'webhook'])->name('webhook.fedapay');




// Routes Breeze (DOIT être AVANT le groupe admin)
require __DIR__.'/auth.php';

// Routes admin (protégées) - IMPORTANT: Placer APRÈS auth.php
Route::middleware(['auth', CheckAdminRole::class]) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        require __DIR__.'/admin.php';
    });

// Routes du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('password.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

// Routes publiques (si vous en avez)
Route::middleware('web')
    ->group(function () {
        require __DIR__.'/front.php';
    });

    // Routes utilisateur (protégées)
Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        
        // Routes pour les contenus utilisateur
        Route::prefix('contenus')->name('contenus.')->group(function () {
            Route::get('/', [UserContenuController::class, 'index'])->name('index');
            Route::get('/create', [UserContenuController::class, 'create'])->name('create');
            Route::post('/', [UserContenuController::class, 'store'])->name('store');
            Route::get('/{id}', [UserContenuController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserContenuController::class, 'edit'])->name('edit');
            Route::put('/{id}', [UserContenuController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserContenuController::class, 'destroy'])->name('destroy');
        });
        
        // Routes pour les médias utilisateur
        Route::prefix('medias')->name('medias.')->group(function () {
            Route::get('/', [UserMediaController::class, 'index'])->name('index');
            Route::get('/create', [UserMediaController::class, 'create'])->name('create');
            Route::post('/', [UserMediaController::class, 'store'])->name('store');
            Route::get('/{id}', [UserMediaController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserMediaController::class, 'edit'])->name('edit'); // Ajoutez cette ligne
            Route::put('/{id}', [UserMediaController::class, 'update'])->name('update');  // Ajoutez cette ligne
            Route::delete('/{id}', [UserMediaController::class, 'destroy'])->name('destroy');
        });
        
        // Route profil utilisateur
        // Routes profil utilisateur - SIMPLE
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::post('/profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    
    });


    // Routes publiques region
Route::get('/regions', [PublicRegionController::class, 'index'])->name('region.index');
Route::get('/regions/{id}', [PublicRegionController::class, 'show'])->name('region.show');


    // Routes publiques langue
Route::get('/langues', [PublicLangueController::class, 'index'])->name('langue.index');
Route::get('/langues/{id}', [PublicLangueController::class, 'show'])->name('langue.show');

// Pages statiques
Route::get('/a-propos', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route pour le formulaire de contact (à créer si nécessaire)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
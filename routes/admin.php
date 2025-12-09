<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TypeContenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeMediaController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TwoFactorAuthController;





// Routes 2FA - ACCESSIBLES SANS 2FA
Route::prefix('2fa')->name('2fa.')->withoutMiddleware([CheckAdminRole::class])->group(function () {
    Route::get('/required', function () {
        return view('admin.two-factor-required');
    })->name('required');
    
    // NOUVELLES ROUTES POUR LE CHALLENGE À CHAQUE CONNEXION
    Route::get('/challenge', [TwoFactorAuthController::class, 'showChallenge'])->name('challenge');
    Route::post('/verify', [TwoFactorAuthController::class, 'verifyChallenge'])->name('verify');
    
    // Routes existantes pour la configuration
    Route::get('/setup', [TwoFactorAuthController::class, 'show'])->name('show');
    Route::post('/confirm', [TwoFactorAuthController::class, 'confirm'])->name('confirm');
    Route::delete('/disable', [TwoFactorAuthController::class, 'destroy'])->name('destroy');
    Route::post('/generate-codes', [TwoFactorAuthController::class, 'generateNewRecoveryCodes'])->name('generate-codes');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Route pour la gestion des langues 
Route::resource('langues', LanguesController::class);

// Routes pour la gestion des contenus
Route::resource('contenus', ContenuController::class);

// Route pour gestion des medias
Route::resource('medias', MediaController::class);

// Route pour la gestion des roles 
Route::resource('roles', RoleController::class);

// Route pour la gestion des régions 
Route::resource('regions', RegionController::class);

// Route pour type contenus
Route::resource('type_contenus', TypeContenuController::class);

// Route pour users
Route::resource('users', UserController::class);

// Route pour type medias
Route::resource('type_medias', TypeMediaController::class);

// Route pour commentaire
Route::resource('commentaires', CommentaireController::class);





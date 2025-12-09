<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User; // <-- 1. Importez votre modèle User

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // =========================================================
        // DÉFINITION DE LA GATE 'delete'
        // Objectif : Bloquer la suppression pour les Managers
        // =========================================================
        Gate::define('delete', function (User $user) {
            // Utilise la méthode d'aide isAdmin() que nous avons définie dans le modèle User
            return $user->isAdmin(); 
        });

        // Gate 'manage' : Permet à Admin et Manager de voir le contenu admin
        Gate::define('manage', function (User $user) {
            return $user->isManagerOrAdmin();
        });
    }
}
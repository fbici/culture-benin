<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            // Utiliser ENUM pour accepter les chaînes de statut que vous utilisez dans le contrôleur.
            // Les options doivent correspondre aux clés utilisées dans getStatutOptions().
            $table->enum('statut', ['brouillon', 'en_attente', 'publie', 'rejete'])
                  ->default('brouillon')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            // Retour au type INT/TINYINT si nécessaire (attention à la perte de données)
            // Remplacez 'tinyInteger' par le type que vous aviez initialement.
            $table->tinyInteger('statut')->change(); 
        });
    }
};
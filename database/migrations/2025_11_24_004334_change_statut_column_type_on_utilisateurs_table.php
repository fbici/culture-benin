<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            // Option 1: ENUM (Recommandé pour les listes fixes de statuts)
            // Cela définit les seules valeurs acceptées dans la colonne statut.
            $table->enum('statut', ['actif', 'inactif', 'suspendu'])->default('inactif')->change();
            
            // Option 2: VARCHAR (Si vous voulez plus de flexibilité, moins propre ici)
            // $table->string('statut', 20)->default('inactif')->change();
        });
    }

    public function down(): void
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            // ATTENTION : Revenir à INT ici pourrait entraîner une perte de données
            // si des chaînes ont été stockées entre-temps.
            // On suppose qu'on revient au type initial (INT) si nécessaire.
            $table->tinyInteger('statut')->change(); // Remplacez tinyInteger par le type initial.
        });
    }
};
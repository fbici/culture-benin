<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            // Ajouter nom_fichier si elle n'existe pas
            if (!Schema::hasColumn('media', 'nom_fichier')) {
                $table->string('nom_fichier')->nullable()->after('Chemin');
            }
            
            // Ajouter statut si elle n'existe pas
            if (!Schema::hasColumn('media', 'statut')) {
                $table->enum('statut', ['actif', 'inactif', 'en_attente'])
                      ->default('actif')
                      ->after('id_contenu');
            }
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            // Supprimer les colonnes dans la migration inverse
            if (Schema::hasColumn('media', 'nom_fichier')) {
                $table->dropColumn('nom_fichier');
            }
            
            if (Schema::hasColumn('media', 'statut')) {
                $table->dropColumn('statut');
            }
        });
    }
};
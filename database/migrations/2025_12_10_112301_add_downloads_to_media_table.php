<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            // Vérifier si la colonne downloads existe déjà
            if (!Schema::hasColumn('media', 'downloads')) {
                $table->integer('downloads')
                      ->default(0)
                      ->after('statut'); // Placez-la après 'statut'
            }
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            // Supprimer la colonne dans la migration inverse
            if (Schema::hasColumn('media', 'downloads')) {
                $table->dropColumn('downloads');
            }
        });
    }
};
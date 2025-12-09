<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifie si la colonne n'existe pas déjà
        if (!Schema::hasColumn('media', 'id_utilisateur')) {
            Schema::table('media', function (Blueprint $table) {
                $table->unsignedBigInteger('id_utilisateur')->nullable()->after('id_type_media');
                
                // Assurez-vous que la table utilisateurs existe avec id_utilisateur
                if (Schema::hasTable('utilisateurs')) {
                    $table->foreign('id_utilisateur')
                          ->references('id_utilisateur')
                          ->on('utilisateurs')
                          ->onDelete('set null');
                }
            });
        }
    }

    public function down()
    {
        // Vérifie si la colonne existe avant de la supprimer
        if (Schema::hasColumn('media', 'id_utilisateur')) {
            Schema::table('media', function (Blueprint $table) {
                $table->dropForeign(['id_utilisateur']);
                $table->dropColumn('id_utilisateur');
            });
        }
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            // Si ces colonnes n'existent pas déjà, les ajouter
            if (!Schema::hasColumn('media', 'titre')) {
                $table->string('titre')->nullable()->after('Chemin');
            }
            
            if (!Schema::hasColumn('media', 'largeur')) {
                $table->integer('largeur')->nullable()->after('titre');
            }
            
            if (!Schema::hasColumn('media', 'hauteur')) {
                $table->integer('hauteur')->nullable()->after('largeur');
            }
            
            if (!Schema::hasColumn('media', 'duree')) {
                $table->integer('duree')->nullable()->comment('Durée en secondes pour vidéo/audio')->after('hauteur');
            }
            
            if (!Schema::hasColumn('media', 'taille_fichier')) {
                $table->bigInteger('taille_fichier')->nullable()->comment('Taille en bytes')->after('duree');
            }
            
            if (!Schema::hasColumn('media', 'mime_type')) {
                $table->string('mime_type')->nullable()->after('taille_fichier');
            }
            
            if (!Schema::hasColumn('media', 'extension')) {
                $table->string('extension', 10)->nullable()->after('mime_type');
            }
            
            if (!Schema::hasColumn('media', 'is_premium')) {
                $table->boolean('is_premium')->default(false)->after('extension');
            }
            
            if (!Schema::hasColumn('media', 'prix')) {
                $table->decimal('prix', 8, 2)->nullable()->after('is_premium');
            }
            
            if (!Schema::hasColumn('media', 'resolution')) {
                $table->string('resolution')->nullable()->after('prix')->comment('Ex: 1920x1080, 4K, HD');
            }
            
            if (!Schema::hasColumn('media', 'auteur_original')) {
                $table->string('auteur_original')->nullable()->after('resolution');
            }
            
            if (!Schema::hasColumn('media', 'copyright')) {
                $table->string('copyright')->nullable()->after('auteur_original');
            }
            
            if (!Schema::hasColumn('media', 'tags')) {
                $table->json('tags')->nullable()->after('copyright');
            }
            
            if (!Schema::hasColumn('media', 'is_valide')) {
                $table->boolean('is_valide')->default(true)->after('tags');
            }
        });
    }

    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $table->dropColumn([
                'titre',
                'largeur',
                'hauteur',
                'duree',
                'taille_fichier',
                'mime_type',
                'extension',
                'is_premium',
                'prix',
                'resolution',
                'auteur_original',
                'copyright',
                'tags',
                'is_valide'
            ]);
        });
    }
};
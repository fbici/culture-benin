<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeContenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'nom' => 'Article Détaillé', 
                'slug' => 'article', 
                'icone_css' => 'bi bi-file-earmark-text',
                'description' => 'Contenu textuel long et structuré : essai, analyse historique ou mythe.'
            ],
            [
                'nom' => 'Documentaire Vidéo', 
                'slug' => 'video', 
                'icone_css' => 'bi bi-camera-video',
                'description' => 'Contenu dont le média principal est une vidéo (interview, performance, documentaire).'
            ],
            [
                'nom' => 'Recette de Cuisine', 
                'slug' => 'recette', 
                'icone_css' => 'bi bi-egg-fried',
                'description' => 'Format structuré dédié aux recettes traditionnelles (ingrédients, étapes, temps de préparation).'
            ],
            [
                'nom' => 'Fichier Audio', 
                'slug' => 'audio', 
                'icone_css' => 'bi bi-music-note-list',
                'description' => 'Contenu dont le média principal est un enregistrement sonore (conte oral, musique rituelle).'
            ],
            [
                'nom' => 'Lieu Historique/Site', 
                'slug' => 'site', 
                'icone_css' => 'bi bi-pin-map',
                'description' => 'Fiche détaillée sur un lieu (musée, temple, village), avec informations géographiques.'
            ],
            [
                'nom' => 'Biographie/Portrait', 
                'slug' => 'portrait', 
                'icone_css' => 'bi bi-person-badge',
                'description' => 'Fiche biographique centrée sur une figure importante du patrimoine béninois.'
            ],
            [
                'nom' => 'Rapport/Archive PDF', 
                'slug' => 'rapport', 
                'icone_css' => 'bi bi-file-pdf',
                'description' => 'Document volumineux destiné à être téléchargé ou consulté en ligne.'
            ],
        ];

        // Vider la table ou s'assurer que l'insertion est sûre
        // Utiliser updateOrInsert pour éviter les erreurs si la table est déjà partiellement remplie
        foreach ($types as $typeData) {
            DB::table('type_contenus')->updateOrInsert(
                ['slug' => $typeData['slug']], // Clé de recherche unique
                [
                    'nom' => $typeData['nom'],
                    'icone_css' => $typeData['icone_css'],
                    'description' => $typeData['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Types de contenu insérés/mis à jour.');
    }
}
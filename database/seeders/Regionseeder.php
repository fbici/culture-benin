<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Regionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Liste des 12 départements du Bénin
        $departements = [
            // Cotonou est dans le Littoral, Parakou dans le Borgou, Bohicon dans le Zou, Natitingou dans l'Atacora.
            // Nous allons insérer les 12 départements pour la cohérence.
            
            ['nom_region' => 'Alibori', 'description' => 'Département du nord-est, frontalier avec le Niger.', 'population' => 867463, 'superficie' => 26242, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Atacora', 'description' => 'Région montagneuse du nord-ouest, abritant les Tata Somba.', 'population' => 841242, 'superficie' => 20499, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Atlantique', 'description' => 'Zone péri-urbaine autour de Cotonou.', 'population' => 1406502, 'superficie' => 3233, 'localisation' => 'Sud'],
            ['nom_region' => 'Borgou', 'description' => 'Département central et nordique, avec Parakou comme capitale.', 'population' => 1214249, 'superficie' => 25856, 'localisation' => 'Centre-Nord'],
            ['nom_region' => 'Collines', 'description' => 'Région du centre-sud, connue pour ses collines et sa culture Mahi.', 'population' => 952303, 'superficie' => 13931, 'localisation' => 'Centre'],
            ['nom_region' => 'Couffo', 'description' => 'Petit département du sud-ouest, riche en culture Adja.', 'population' => 745863, 'superficie' => 2404, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Donga', 'description' => 'Région du nord-ouest, avec Djougou comme centre urbain.', 'population' => 543130, 'superficie' => 11126, 'localisation' => 'Nord'],
            ['nom_region' => 'Littoral', 'description' => 'Le plus petit département, abritant la capitale économique Cotonou.', 'population' => 678852, 'superficie' => 79, 'localisation' => 'Côtier'],
            ['nom_region' => 'Mono', 'description' => 'Région côtière du sud-ouest.', 'population' => 495405, 'superficie' => 1605, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Ouémé', 'description' => 'Région du sud-est, avec Porto-Novo comme capitale politique.', 'population' => 1357605, 'superficie' => 2814, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Plateau', 'description' => 'Région du sud-est, culture Yoruba et Nago.', 'population' => 716766, 'superficie' => 3264, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Zou', 'description' => 'Région centrale, fief historique du royaume d\'Abomey.', 'population' => 851966, 'superficie' => 5243, 'localisation' => 'Centre'],
        ];

        foreach ($departements as $regionData) {
            DB::table('regions')->updateOrInsert(
                ['nom_region' => $regionData['nom_region']], // Cherche par le nom pour éviter les doublons
                [
                    'description' => $regionData['description'],
                    'population' => $regionData['population'],
                    'superficie' => $regionData['superficie'],
                    'localisation' => $regionData['localisation'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Départements ajoutés/mis à jour avec succès.');
    }
}
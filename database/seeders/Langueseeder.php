<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Langueseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Liste des langues principales (hors Fon, Français, Goun, Yoruba)
        $langues = [
            ['nom_langue' => 'Adja', 'code_langue' => 'aja', 'description' => 'Langue majoritairement parlée dans le Couffo et le Mono.'],
            ['nom_langue' => 'Bariba', 'code_langue' => 'bba', 'description' => 'Langue dominante dans le Borgou, au nord-est.'],
            ['nom_langue' => 'Dendi', 'code_langue' => 'den', 'description' => 'Langue commerciale et culturelle du nord (Alibori).'],
            ['nom_langue' => 'Mahi', 'code_langue' => 'mhi', 'description' => 'Langue du centre du Bénin (Collines).'],
            ['nom_langue' => 'Mina', 'code_langue' => 'min', 'description' => 'Langue côtière, souvent confondue avec le Goun.'],
            ['nom_langue' => 'Biali (Biyobe)', 'code_langue' => 'biali', 'description' => 'Langue parlée dans l\'Atacora.'],
        ];

        // Pour éviter les doublons, on utilise les codes de langue (code_langue)
        foreach ($langues as $langueData) {
            DB::table('langues')->updateOrInsert(
                ['code_langue' => $langueData['code_langue']],
                [
                    'nom_langue' => $langueData['nom_langue'],
                    'description' => $langueData['description'],
                    // Si vos tables n'ont pas de colonnes created_at/updated_at, retirez les lignes ci-dessous
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Langues manquantes ajoutées/mises à jour avec succès.');
    }
}
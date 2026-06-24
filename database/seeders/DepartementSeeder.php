<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $departements = [
            [
                'nom' => 'Informatique',
                'localisation' => 'Casablanca',
                'description' => 'Département responsable du développement logiciel, de l\'infrastructure IT et du support technique.',
            ],
            [
                'nom' => 'Ressources Humaines',
                'localisation' => 'Casablanca',
                'description' => 'Gestion du personnel, recrutement, formation et relations sociales.',
            ],
            [
                'nom' => 'Finance',
                'localisation' => 'Rabat',
                'description' => 'Comptabilité, gestion financière, contrôle de gestion et trésorerie.',
            ],
            [
                'nom' => 'Marketing',
                'localisation' => 'Casablanca',
                'description' => 'Stratégie marketing, communication digitale, gestion de marque et événementiel.',
            ],
            [
                'nom' => 'Commercial',
                'localisation' => 'Marrakech',
                'description' => 'Ventes, développement commercial, gestion de la relation client.',
            ],
            [
                'nom' => 'Juridique',
                'localisation' => 'Rabat',
                'description' => 'Conseil juridique, gestion des contrats et conformité réglementaire.',
            ],
            [
                'nom' => 'Logistique',
                'localisation' => 'Tanger',
                'description' => 'Gestion de la chaîne d\'approvisionnement, stockage et distribution.',
            ],
            [
                'nom' => 'Direction Générale',
                'localisation' => 'Casablanca',
                'description' => 'Pilotage stratégique, gouvernance et supervision de l\'ensemble des activités.',
            ],
        ];

        foreach ($departements as $departement) {
            Departement::create($departement);
        }
    }
}

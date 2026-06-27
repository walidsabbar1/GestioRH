<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EmployeSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure the storage directory for employee photos exists
        $storagePath = storage_path('app/public/employes');
        if (!File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }

        // Copy seed images into storage so they are available after a fresh seed
        $seedImagesPath = database_path('seeders/images');
        if (File::isDirectory($seedImagesPath)) {
            foreach (File::files($seedImagesPath) as $file) {
                File::copy($file->getPathname(), $storagePath . '/' . $file->getFilename());
            }
        }

        $employes = [
            // Informatique (departement_id: 1)
            ['nom' => 'Benali', 'prenom' => 'Youssef', 'email' => 'y.benali@rhmanager.com', 'fonction' => 'Développeur Full Stack', 'salaire' => 12000, 'date_embauche' => '2023-01-15', 'departement_id' => 1, 'photo' => 'employes/employee1.jpg'],
            ['nom' => 'El Amrani', 'prenom' => 'Sara', 'email' => 's.elamrani@rhmanager.com', 'fonction' => 'Ingénieure DevOps', 'salaire' => 14000, 'date_embauche' => '2022-06-01', 'departement_id' => 1, 'photo' => 'employes/employee2.jpg'],
            ['nom' => 'Tazi', 'prenom' => 'Amine', 'email' => 'a.tazi@rhmanager.com', 'fonction' => 'Chef de Projet IT', 'salaire' => 18000, 'date_embauche' => '2021-03-10', 'departement_id' => 1, 'photo' => 'employes/employee3.jpg'],
            ['nom' => 'Ouazzani', 'prenom' => 'Leila', 'email' => 'l.ouazzani@rhmanager.com', 'fonction' => 'Développeuse Frontend', 'salaire' => 10000, 'date_embauche' => '2024-02-20', 'departement_id' => 1, 'photo' => 'employes/employee4.jpg'],
            ['nom' => 'Chraibi', 'prenom' => 'Mehdi', 'email' => 'm.chraibi@rhmanager.com', 'fonction' => 'Administrateur Systèmes', 'salaire' => 13000, 'date_embauche' => '2022-09-05', 'departement_id' => 1, 'photo' => 'employes/employee5.jpg'],

            // Ressources Humaines (departement_id: 2)
            ['nom' => 'Fassi', 'prenom' => 'Khadija', 'email' => 'k.fassi@rhmanager.com', 'fonction' => 'Responsable RH', 'salaire' => 16000, 'date_embauche' => '2020-07-01', 'departement_id' => 2, 'photo' => 'employes/employee6.jpg'],
            ['nom' => 'Berrada', 'prenom' => 'Omar', 'email' => 'o.berrada@rhmanager.com', 'fonction' => 'Chargé de Recrutement', 'salaire' => 9500, 'date_embauche' => '2023-04-12', 'departement_id' => 2, 'photo' => 'employes/employee7.jpg'],
            ['nom' => 'Alaoui', 'prenom' => 'Fatima', 'email' => 'f.alaoui@rhmanager.com', 'fonction' => 'Gestionnaire Paie', 'salaire' => 11000, 'date_embauche' => '2022-01-08', 'departement_id' => 2, 'photo' => 'employes/employee8.jpg'],

            // Finance (departement_id: 3)
            ['nom' => 'Benjelloun', 'prenom' => 'Hassan', 'email' => 'h.benjelloun@rhmanager.com', 'fonction' => 'Directeur Financier', 'salaire' => 25000, 'date_embauche' => '2019-05-15', 'departement_id' => 3, 'photo' => 'employes/employee9.jpg'],
            ['nom' => 'Idrissi', 'prenom' => 'Nadia', 'email' => 'n.idrissi@rhmanager.com', 'fonction' => 'Comptable Senior', 'salaire' => 12000, 'date_embauche' => '2021-11-20', 'departement_id' => 3, 'photo' => 'employes/employee10.jpg'],
            ['nom' => 'Kettani', 'prenom' => 'Rachid', 'email' => 'r.kettani@rhmanager.com', 'fonction' => 'Contrôleur de Gestion', 'salaire' => 15000, 'date_embauche' => '2022-03-01', 'departement_id' => 3, 'photo' => 'employes/employee1.jpg'],
            ['nom' => 'Mansouri', 'prenom' => 'Imane', 'email' => 'i.mansouri@rhmanager.com', 'fonction' => 'Analyste Financier', 'salaire' => 11000, 'date_embauche' => '2023-08-14', 'departement_id' => 3, 'photo' => 'employes/employee2.jpg'],

            // Marketing (departement_id: 4)
            ['nom' => 'El Idrissi', 'prenom' => 'Zineb', 'email' => 'z.elidrissi@rhmanager.com', 'fonction' => 'Directrice Marketing', 'salaire' => 20000, 'date_embauche' => '2020-02-01', 'departement_id' => 4, 'photo' => 'employes/employee3.jpg'],
            ['nom' => 'Bouazzaoui', 'prenom' => 'Karim', 'email' => 'k.bouazzaoui@rhmanager.com', 'fonction' => 'Community Manager', 'salaire' => 8500, 'date_embauche' => '2023-06-15', 'departement_id' => 4, 'photo' => 'employes/employee4.jpg'],
            ['nom' => 'Senhaji', 'prenom' => 'Salma', 'email' => 's.senhaji@rhmanager.com', 'fonction' => 'Graphiste', 'salaire' => 9000, 'date_embauche' => '2024-01-10', 'departement_id' => 4, 'photo' => 'employes/employee5.jpg'],

            // Commercial (departement_id: 5)
            ['nom' => 'Lahlou', 'prenom' => 'Adil', 'email' => 'a.lahlou@rhmanager.com', 'fonction' => 'Directeur Commercial', 'salaire' => 22000, 'date_embauche' => '2019-09-01', 'departement_id' => 5, 'photo' => 'employes/employee6.jpg'],
            ['nom' => 'Ziani', 'prenom' => 'Amina', 'email' => 'a.ziani@rhmanager.com', 'fonction' => 'Responsable Ventes', 'salaire' => 14000, 'date_embauche' => '2021-05-20', 'departement_id' => 5, 'photo' => 'employes/employee7.jpg'],
            ['nom' => 'El Fassi', 'prenom' => 'Yassine', 'email' => 'y.elfassi@rhmanager.com', 'fonction' => 'Chargé de Clientèle', 'salaire' => 8500, 'date_embauche' => '2023-10-01', 'departement_id' => 5, 'photo' => 'employes/employee8.jpg'],
            ['nom' => 'Naciri', 'prenom' => 'Hajar', 'email' => 'h.naciri@rhmanager.com', 'fonction' => 'Commercial Terrain', 'salaire' => 7500, 'date_embauche' => '2024-03-01', 'departement_id' => 5, 'photo' => 'employes/employee9.jpg'],

            // Juridique (departement_id: 6)
            ['nom' => 'Benhaddou', 'prenom' => 'Mourad', 'email' => 'm.benhaddou@rhmanager.com', 'fonction' => 'Directeur Juridique', 'salaire' => 24000, 'date_embauche' => '2018-12-01', 'departement_id' => 6, 'photo' => 'employes/employee10.jpg'],
            ['nom' => 'Sqalli', 'prenom' => 'Meryem', 'email' => 'm.sqalli@rhmanager.com', 'fonction' => 'Juriste d\'Entreprise', 'salaire' => 13000, 'date_embauche' => '2022-07-15', 'departement_id' => 6, 'photo' => 'employes/employee1.jpg'],

            // Logistique (departement_id: 7)
            ['nom' => 'Bouzidi', 'prenom' => 'Khalid', 'email' => 'k.bouzidi@rhmanager.com', 'fonction' => 'Responsable Logistique', 'salaire' => 15000, 'date_embauche' => '2020-10-01', 'departement_id' => 7, 'photo' => 'employes/employee2.jpg'],
            ['nom' => 'Amrani', 'prenom' => 'Soukaina', 'email' => 's.amrani@rhmanager.com', 'fonction' => 'Coordinatrice Supply Chain', 'salaire' => 10000, 'date_embauche' => '2023-02-15', 'departement_id' => 7, 'photo' => 'employes/employee3.jpg'],
            ['nom' => 'Mouline', 'prenom' => 'Driss', 'email' => 'd.mouline@rhmanager.com', 'fonction' => 'Magasinier', 'salaire' => 6500, 'date_embauche' => '2024-05-01', 'departement_id' => 7, 'photo' => 'employes/employee4.jpg'],

            // Direction Générale (departement_id: 8)
            ['nom' => 'El Mansouri', 'prenom' => 'Ahmed', 'email' => 'a.elmansouri@rhmanager.com', 'fonction' => 'Directeur Général', 'salaire' => 45000, 'date_embauche' => '2015-01-01', 'departement_id' => 8, 'photo' => 'employes/employee5.jpg'],
            ['nom' => 'Cherkaoui', 'prenom' => 'Samira', 'email' => 's.cherkaoui@rhmanager.com', 'fonction' => 'Assistante de Direction', 'salaire' => 12000, 'date_embauche' => '2019-03-15', 'departement_id' => 8, 'photo' => 'employes/employee6.jpg'],
        ];

        foreach ($employes as $employe) {
            Employe::create($employe);
        }
    }
}


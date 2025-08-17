<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\User;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $types = [
            'Notes de service',
            'Guides',
            'Manuels de procédures',
            'Textes réglementaires et législatifs',
            'Tarifs',
            'Supports de formation',
            'Organigrammes et répertoire interne',
            'Politiques et chartes internes'
        ];

        $titres = [
            'Procédure de recrutement',
            'Guide de sécurité',
            'Manuel utilisateur',
            'Règlement intérieur',
            'Grille tarifaire 2025',
            'Formation sécurité',
            'Organigramme SAAR',
            'Charte éthique',
            'Procédure qualité',
            'Guide maintenance',
            'Manuel procédures RH',
            'Règlement sécurité',
            'Tarifs services',
            'Formation qualité',
            'Répertoire contacts',
            'Politique environnementale'
        ];

        $descriptions = [
            'Document détaillant les étapes du processus de recrutement',
            'Guide complet sur les mesures de sécurité à respecter',
            'Manuel d\'utilisation du système informatique',
            'Règlement intérieur de l\'entreprise',
            'Grille tarifaire des services proposés',
            'Support de formation à la sécurité',
            'Organigramme de l\'entreprise SAAR',
            'Charte éthique et valeurs de l\'entreprise',
            'Procédures qualité ISO 9001',
            'Guide de maintenance préventive',
            'Manuel des procédures ressources humaines',
            'Règlement de sécurité incendie',
            'Tarifs des services externes',
            'Formation aux procédures qualité',
            'Répertoire des contacts internes',
            'Politique environnementale et développement durable'
        ];

        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $type = $types[array_rand($types)];
            $titre = $titres[array_rand($titres)];
            $description = $descriptions[array_rand($descriptions)];
            
            Document::create([
                'titre' => $titre,
                'description' => $description,
                'type' => $type,
                'fichier' => 'document_' . ($i + 1) . '.pdf',
                'extension' => 'pdf',
                'taille' => rand(100000, 5000000), // 100KB à 5MB
                'chemin_fichier' => 'documents/document_' . ($i + 1) . '.pdf',
                'user_id' => $user->id,
                'est_public' => rand(0, 1),
                'date_publication' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur administrateur par défaut
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@saardoc.com',
            'matricule' => 'SAARCI000',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'est_bloque' => false,
        ]);

        // Créer un utilisateur RH par défaut
        User::create([
            'name' => 'Ressources Humaines',
            'email' => 'rh@saardoc.com',
            'matricule' => 'SAARCI001',
            'password' => Hash::make('password'),
            'role' => 'rh',
            'est_bloque' => false,
        ]);

        // Créer un utilisateur employé par défaut
        User::create([
            'name' => 'Employé Test',
            'email' => 'employe@saardoc.com',
            'matricule' => 'SAARCI002',
            'password' => Hash::make('password'),
            'role' => 'employe',
            'est_bloque' => false,
        ]);
    }
}

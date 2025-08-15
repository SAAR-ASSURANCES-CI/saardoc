<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin SAAR',
            'email' => 'admin@saar.ci',
            'matricule' => 'SAARCI001',
        ]);

        User::factory()->create([
            'name' => 'Utilisateur Test',
            'email' => 'test@saar.ci',
            'matricule' => 'SAARCI002',
        ]);
    }
}

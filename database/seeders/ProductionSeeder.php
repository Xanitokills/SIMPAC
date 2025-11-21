<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database for production.
     * Creates all users shown in the login page.
     */
    public function run(): void
    {
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('🌱 SIMPAC - Seeder de Producción');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();

        // Lista de usuarios a crear (deben coincidir con los del login)
        $users = [
            [
                'name' => 'Administrador del Sistema',
                'email' => 'admin@simpac.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Secretario CTPPGE',
                'email' => 'secretario@simpac.com',
                'password' => 'secretario123',
                'role' => 'secretario_ctppge',
            ],
            [
                'name' => 'Procurador(a) PGE',
                'email' => 'procurador@simpac.com',
                'password' => 'procurador123',
                'role' => 'procurador_pge',
            ],
            [
                'name' => 'Juan Carlos Pérez',
                'email' => 'juan.perez@simpac.com',
                'password' => 'sectorista123',
                'role' => 'sectorista',
            ],
            [
                'name' => 'María Rodríguez',
                'email' => 'maria.rodriguez@simpac.com',
                'password' => 'sectorista123',
                'role' => 'sectorista',
            ],
            [
                'name' => 'Carlos Mendoza',
                'email' => 'carlos.mendoza@simpac.com',
                'password' => 'sectorista123',
                'role' => 'sectorista',
            ],
            [
                'name' => 'Responsable de Componente',
                'email' => 'responsable@simpac.com',
                'password' => 'responsable123',
                'role' => 'responsable_componente',
            ],
            [
                'name' => 'Miembro Órgano Colegiado',
                'email' => 'colegiado@simpac.com',
                'password' => 'colegiado123',
                'role' => 'organo_colegiado',
            ],
        ];

        foreach ($users as $userData) {
            if (User::where('email', $userData['email'])->exists()) {
                $this->command->warn("⚠️  Usuario {$userData['email']} ya existe, omitiendo...");
            } else {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role'],
                ]);
                $this->command->info("✅ Usuario creado: {$userData['email']}");
            }
        }

        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Seeder de producción completado!');
        $this->command->info('   Total usuarios: ' . User::count());
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sectorista;
use Illuminate\Support\Facades\Hash;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 0. Administrador - Acceso total al sistema
        User::updateOrCreate(
            ['email' => 'admin@simpac.com'],
            [
                'name' => 'Administrador del Sistema',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'sectorista_id' => null,
            ]
        );
        $this->command->info('✓ Creado usuario: Administrador');

        // 1. Secretario CTPPGE - Coordinador general del proceso
        User::updateOrCreate(
            ['email' => 'secretario@simpac.com'],
            [
                'name' => 'Secretario CTPPGE',
                'password' => Hash::make('secretario123'),
                'role' => 'secretario_ctppge',
                'sectorista_id' => null,
            ]
        );
        $this->command->info('✓ Creado usuario: Secretario CTPPGE');

        // 2. Procurador(a) PGE - Validación legal y suscripción de actas
        User::updateOrCreate(
            ['email' => 'procurador@simpac.com'],
            [
                'name' => 'Procurador(a) PGE',
                'password' => Hash::make('procurador123'),
                'role' => 'procurador_pge',
                'sectorista_id' => null,
            ]
        );
        $this->command->info('✓ Creado usuario: Procurador(a) PGE');

        // 3. Responsable de Componente - Ejecutor de componentes específicos
        User::updateOrCreate(
            ['email' => 'responsable@simpac.com'],
            [
                'name' => 'Responsable de Componente',
                'password' => Hash::make('responsable123'),
                'role' => 'responsable_componente',
                'sectorista_id' => null,
            ]
        );
        $this->command->info('✓ Creado usuario: Responsable de Componente');

        // 4. Órgano Colegiado - Aprobación de planes y validación
        User::updateOrCreate(
            ['email' => 'colegiado@simpac.com'],
            [
                'name' => 'Órgano Colegiado',
                'password' => Hash::make('colegiado123'),
                'role' => 'organo_colegiado',
                'sectorista_id' => null,
            ]
        );
        $this->command->info('✓ Creado usuario: Órgano Colegiado');

        // 5. Sectoristas - Vinculados a los sectoristas existentes
        $sectoristas = Sectorista::all();
        
        if ($sectoristas->isEmpty()) {
            $this->command->warn('No hay sectoristas. Ejecuta SectoristaSeeder primero.');
            return;
        }

        foreach ($sectoristas as $index => $sectorista) {
            $email = strtolower(str_replace(' ', '.', $sectorista->name)) . '@simpac.com';
            
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $sectorista->name,
                    'password' => Hash::make('sectorista123'),
                    'role' => 'sectorista',
                    'sectorista_id' => $sectorista->id,
                ]
            );
            
            $this->command->info("✓ Creado usuario sectorista: {$sectorista->name}");
        }

        $this->command->info("\n=== USUARIOS CREADOS ===");
        $this->command->info('Administrador:');
        $this->command->info('  Email: admin@simpac.com');
        $this->command->info('  Password: admin123');
        $this->command->info('');
        $this->command->info('Secretario CTPPGE:');
        $this->command->info('  Email: secretario@simpac.com');
        $this->command->info('  Password: secretario123');
        $this->command->info('');
        $this->command->info('Procurador(a) PGE:');
        $this->command->info('  Email: procurador@simpac.com');
        $this->command->info('  Password: procurador123');
        $this->command->info('');
        $this->command->info('Responsable de Componente:');
        $this->command->info('  Email: responsable@simpac.com');
        $this->command->info('  Password: responsable123');
        $this->command->info('');
        $this->command->info('Órgano Colegiado:');
        $this->command->info('  Email: colegiado@simpac.com');
        $this->command->info('  Password: colegiado123');
        $this->command->info('');
        $this->command->info('Sectoristas:');
        $this->command->info('  Password: sectorista123');
        $this->command->info('  (Emails según nombres de sectoristas)');
    }
}

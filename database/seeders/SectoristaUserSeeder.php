<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sectorista;
use Illuminate\Support\Facades\Hash;

class SectoristaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando usuarios para sectoristas...');

        // Sectorista 1: Juan Carlos Pérez García
        User::updateOrCreate(
            ['email' => 'juan.perez@simpac.com'],
            [
                'name' => 'Juan Carlos Pérez García',
                'password' => Hash::make('sectorista123'),
                'role' => 'sectorista',
                'sectorista_id' => 1
            ]
        );
        $this->command->info('✓ Juan Carlos Pérez García');

        // Sectorista 2: María Elena Rodríguez López  
        User::updateOrCreate(
            ['email' => 'maria.rodriguez@simpac.com'],
            [
                'name' => 'María Elena Rodríguez López',
                'password' => Hash::make('sectorista123'),
                'role' => 'sectorista',
                'sectorista_id' => 2
            ]
        );
        $this->command->info('✓ María Elena Rodríguez López');

        // Sectorista 3: Carlos Alberto Mendoza Silva
        User::updateOrCreate(
            ['email' => 'carlos.mendoza@simpac.com'],
            [
                'name' => 'Carlos Alberto Mendoza Silva',
                'password' => Hash::make('sectorista123'),
                'role' => 'sectorista',
                'sectorista_id' => 3
            ]
        );
        $this->command->info('✓ Carlos Alberto Mendoza Silva');

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Usuarios Sectoristas Creados');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('🔐 CREDENCIALES DE SECTORISTAS:');
        $this->command->info('');
        $this->command->info('👤 Sectorista 1:');
        $this->command->line('   Email: juan.perez@simpac.com');
        $this->command->line('   Contraseña: sectorista123');
        $this->command->line('   Entidades asignadas: Ver en Actividad 2');
        $this->command->info('');
        $this->command->info('👤 Sectorista 2:');
        $this->command->line('   Email: maria.rodriguez@simpac.com');
        $this->command->line('   Contraseña: sectorista123');
        $this->command->line('   Entidades asignadas: Ver en Actividad 2');
        $this->command->info('');
        $this->command->info('👤 Sectorista 3:');
        $this->command->line('   Email: carlos.mendoza@simpac.com');
        $this->command->line('   Contraseña: sectorista123');
        $this->command->line('   Entidades asignadas: Ver en Actividad 2');
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

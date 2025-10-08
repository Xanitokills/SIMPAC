<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sectorista;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creando usuarios del sistema...');

        // 1. ADMIN - Acceso total
        User::create([
            'name' => 'Administrador del Sistema',
            'email' => 'admin@simpac.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        $this->command->info('✓ Admin creado');

        // 2. SECRETARIO CTPPGE - Coordinador general
        User::create([
            'name' => 'Carlos Mendoza Rivera',
            'email' => 'secretario@simpac.com',
            'password' => Hash::make('secretario123'),
            'role' => 'secretario_ctppge',
        ]);
        $this->command->info('✓ Secretario CTPPGE creado');

        // 3. PROCURADOR PGE - Validación legal
        User::create([
            'name' => 'Dra. María Elena Torres',
            'email' => 'procurador@simpac.com',
            'password' => Hash::make('procurador123'),
            'role' => 'procurador_pge',
        ]);
        $this->command->info('✓ Procurador PGE creado');

        // 4. RESPONSABLE DE COMPONENTE - Ejecutor
        User::create([
            'name' => 'Ing. Roberto Sánchez',
            'email' => 'responsable@simpac.com',
            'password' => Hash::make('responsable123'),
            'role' => 'responsable_componente',
        ]);
        $this->command->info('✓ Responsable de Componente creado');

        // 5. ÓRGANO COLEGIADO - Aprobación
        User::create([
            'name' => 'Comité de Validación',
            'email' => 'colegiado@simpac.com',
            'password' => Hash::make('colegiado123'),
            'role' => 'organo_colegiado',
        ]);
        $this->command->info('✓ Órgano Colegiado creado');

        // 6. SECTORISTA - Gestión de Actividad 2
        // Primero verificamos si existe algún sectorista en la base de datos
        $sectorista = Sectorista::first();
        
        if ($sectorista) {
            User::create([
                'name' => $sectorista->name,
                'email' => 'sectorista@simpac.com',
                'password' => Hash::make('sectorista123'),
                'role' => 'sectorista',
                'sectorista_id' => $sectorista->id,
            ]);
            $this->command->info('✓ Sectorista creado y vinculado');
        } else {
            // Si no hay sectoristas, creamos el usuario sin vincular
            User::create([
                'name' => 'Sectorista de Prueba',
                'email' => 'sectorista@simpac.com',
                'password' => Hash::make('sectorista123'),
                'role' => 'sectorista',
            ]);
            $this->command->warn('⚠ Sectorista creado pero no vinculado (ejecuta SectoristaSeeder primero)');
        }

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Usuarios creados exitosamente');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->line('Credenciales de acceso:');
        $this->command->info('');
        $this->command->info('👑 ADMIN:');
        $this->command->line('   Email: admin@simpac.com');
        $this->command->line('   Contraseña: admin123');
        $this->command->info('');
        $this->command->info('🎯 SECRETARIO CTPPGE:');
        $this->command->line('   Email: secretario@simpac.com');
        $this->command->line('   Contraseña: secretario123');
        $this->command->info('');
        $this->command->info('⚖️ PROCURADOR PGE:');
        $this->command->line('   Email: procurador@simpac.com');
        $this->command->line('   Contraseña: procurador123');
        $this->command->info('');
        $this->command->info('👥 SECTORISTA:');
        $this->command->line('   Email: sectorista@simpac.com');
        $this->command->line('   Contraseña: sectorista123');
        $this->command->info('');
        $this->command->info('◆ RESPONSABLE DE COMPONENTE:');
        $this->command->line('   Email: responsable@simpac.com');
        $this->command->line('   Contraseña: responsable123');
        $this->command->info('');
        $this->command->info('◆ ÓRGANO COLEGIADO:');
        $this->command->line('   Email: colegiado@simpac.com');
        $this->command->line('   Contraseña: colegiado123');
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

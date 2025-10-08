<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Este seeder carga TODO: usuarios + datos de prueba
     * Para cargar solo datos de prueba, usa: php artisan db:seed --class=TestDataSeeder
     */
    public function run(): void
    {
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('🌱 SIMPAC - Inicialización Completa de Base de Datos');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
        
        // 1. Crear usuarios del sistema (Admin, Secretario, Procurador, etc.)
        $this->command->info('👥 Paso 1/5: Creando usuarios del sistema...');
        $this->call(UserSeeder::class);
        $this->command->newLine();
        
        // 2. Crear entidades
        $this->command->info('🏢 Paso 2/5: Creando entidades...');
        $this->call(EntitySeeder::class);
        $this->command->newLine();
        
        // 3. Crear sectoristas
        $this->command->info('👔 Paso 3/5: Creando sectoristas...');
        $this->call(SectoristaSeeder::class);
        $this->command->newLine();
        
        // 4. Crear plan de implementación y asignaciones
        $this->command->info('📊 Paso 4/5: Creando planes y asignaciones...');
        $this->call(ImplementationPlanSeeder::class);
        $this->command->newLine();
        
        // 5. Crear datos de Actividad 2 (reuniones, oficios, etc.)
        $this->command->info('📋 Paso 5/5: Creando datos de Actividad 2...');
        $this->call(Activity2Seeder::class);
        $this->command->newLine();
        
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Base de datos inicializada correctamente!');
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

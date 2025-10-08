<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Este seeder carga SOLO datos de prueba, sin usuarios
     */
    public function run(): void
    {
        $this->command->info('🌱 Cargando datos de prueba...');
        $this->command->newLine();
        
        // 1. Crear entidades
        $this->command->info('1️⃣  Creando entidades...');
        $this->call(EntitySeeder::class);
        
        // 2. Crear sectoristas
        $this->command->info('2️⃣  Creando sectoristas...');
        $this->call(SectoristaSeeder::class);
        
        // 3. Crear plan de implementación y asignaciones
        $this->command->info('3️⃣  Creando planes y asignaciones...');
        $this->call(ImplementationPlanSeeder::class);
        
        // 4. Crear datos de Actividad 2 (reuniones, oficios, etc.)
        $this->command->info('4️⃣  Creando datos de Actividad 2...');
        $this->call(Activity2Seeder::class);
        
        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Datos de prueba cargados correctamente!');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();
        $this->command->line('Puedes acceder con cualquiera de estos usuarios:');
        $this->command->line('  👑 admin@simpac.com / admin123');
        $this->command->line('  🎯 secretario@simpac.com / secretario123');
        $this->command->line('  👥 sectorista@simpac.com / sectorista123');
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

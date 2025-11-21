<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database for production.
     * Creates only essential users without test data.
     */
    public function run(): void
    {
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('🌱 SIMPAC - Seeder de Producción');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();

        // Check if admin already exists
        if (User::where('email', 'admin@simpac.com')->exists()) {
            $this->command->warn('⚠️  Usuario admin ya existe, omitiendo...');
        } else {
            // Create admin user
            User::create([
                'name' => 'Administrador del Sistema',
                'email' => 'admin@simpac.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            $this->command->info('✅ Usuario admin creado');
            $this->command->info('   Email: admin@simpac.com');
            $this->command->info('   Password: admin123');
            $this->command->warn('   ⚠️  CAMBIAR LA CONTRASEÑA DESPUÉS DEL PRIMER LOGIN');
        }

        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Seeder de producción completado!');
        $this->command->info('═══════════════════════════════════════════════════════');
    }
}

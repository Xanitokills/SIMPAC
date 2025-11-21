<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sectorista;
use App\Models\Entity;
use App\Models\ImplementationPlan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database for production.
     * Creates all users shown in the login page, plus sectoristas and entities.
     */
    public function run(): void
    {
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('🌱 SIMPAC - Seeder de Producción');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();

        // Crear entidades si no existen
        $this->seedEntities();
        
        // Crear sectoristas si no existen
        $this->seedSectoristas();
        
        // Crear plan de implementación si no existe
        $this->seedImplementationPlan();

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
        $this->command->info('   Total sectoristas: ' . Sectorista::count());
        $this->command->info('   Total entidades: ' . Entity::count());
        $this->command->info('   Total planes: ' . ImplementationPlan::count());
        $this->command->info('═══════════════════════════════════════════════════════');
    }
    
    /**
     * Seed entities for production
     */
    private function seedEntities(): void
    {
        $this->command->info('🏢 Creando entidades...');
        
        $entities = [
            // Ministerios
            ['name' => 'Ministerio de Economía y Finanzas', 'type' => 'ministerio', 'sector' => 'Economía', 'status' => 'active'],
            ['name' => 'Ministerio de Educación', 'type' => 'ministerio', 'sector' => 'Educación', 'status' => 'active'],
            ['name' => 'Ministerio de Salud', 'type' => 'ministerio', 'sector' => 'Salud', 'status' => 'active'],
            ['name' => 'Ministerio del Interior', 'type' => 'ministerio', 'sector' => 'Interior', 'status' => 'active'],
            ['name' => 'Ministerio de Defensa', 'type' => 'ministerio', 'sector' => 'Defensa', 'status' => 'active'],
            ['name' => 'Ministerio de Justicia', 'type' => 'ministerio', 'sector' => 'Justicia', 'status' => 'active'],
            ['name' => 'Ministerio de Trabajo', 'type' => 'ministerio', 'sector' => 'Trabajo', 'status' => 'active'],
            ['name' => 'Ministerio de Agricultura', 'type' => 'ministerio', 'sector' => 'Agricultura', 'status' => 'active'],
            
            // Organismos Públicos
            ['name' => 'SUNAT', 'type' => 'organismo_publico', 'sector' => 'Economía', 'status' => 'active'],
            ['name' => 'RENIEC', 'type' => 'organismo_publico', 'sector' => 'Registros', 'status' => 'active'],
            ['name' => 'INDECOPI', 'type' => 'organismo_publico', 'sector' => 'Competencia', 'status' => 'active'],
            ['name' => 'OSINERGMIN', 'type' => 'organismo_publico', 'sector' => 'Energía', 'status' => 'active'],
            ['name' => 'OSIPTEL', 'type' => 'organismo_publico', 'sector' => 'Telecomunicaciones', 'status' => 'active'],
            ['name' => 'SUNASS', 'type' => 'organismo_publico', 'sector' => 'Saneamiento', 'status' => 'active'],
            
            // Gobiernos Regionales
            ['name' => 'Gobierno Regional de Lima', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional del Callao', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Arequipa', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Cusco', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de Piura', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            ['name' => 'Gobierno Regional de La Libertad', 'type' => 'gobierno_regional', 'sector' => 'Regional', 'status' => 'active'],
            
            // Gobiernos Locales
            ['name' => 'Municipalidad Metropolitana de Lima', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad Provincial del Callao', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de Miraflores', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de San Isidro', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            ['name' => 'Municipalidad de Surco', 'type' => 'gobierno_local', 'sector' => 'Local', 'status' => 'active'],
            
            // Empresas Públicas
            ['name' => 'SEDAPAL', 'type' => 'empresa_publica', 'sector' => 'Saneamiento', 'status' => 'active'],
            ['name' => 'Electroperú', 'type' => 'empresa_publica', 'sector' => 'Energía', 'status' => 'active'],
            ['name' => 'PETROPERU', 'type' => 'empresa_publica', 'sector' => 'Energía', 'status' => 'active'],
        ];

        $created = 0;
        foreach ($entities as $entityData) {
            if (!Entity::where('name', $entityData['name'])->exists()) {
                Entity::create($entityData);
                $created++;
            }
        }
        $this->command->info("   ✅ {$created} entidades creadas");
    }
    
    /**
     * Seed sectoristas for production
     */
    private function seedSectoristas(): void
    {
        $this->command->info('👔 Creando sectoristas...');
        
        $sectoristas = [
            [
                'name' => 'Juan Carlos Pérez García',
                'email' => 'jperez@pge.gob.pe',
                'phone' => '987654321',
                'status' => 'active',
            ],
            [
                'name' => 'María Elena Rodríguez López',
                'email' => 'mrodriguez@pge.gob.pe',
                'phone' => '987654322',
                'status' => 'active',
            ],
            [
                'name' => 'Carlos Alberto Mendoza Silva',
                'email' => 'cmendoza@pge.gob.pe',
                'phone' => '987654323',
                'status' => 'active',
            ],
            [
                'name' => 'Ana Patricia Torres Vargas',
                'email' => 'atorres@pge.gob.pe',
                'phone' => '987654324',
                'status' => 'active',
            ],
            [
                'name' => 'Luis Fernando Castillo Ramos',
                'email' => 'lcastillo@pge.gob.pe',
                'phone' => '987654325',
                'status' => 'active',
            ],
            [
                'name' => 'Rosa María Flores Gutiérrez',
                'email' => 'rflores@pge.gob.pe',
                'phone' => '987654326',
                'status' => 'active',
            ],
            [
                'name' => 'Miguel Ángel Sánchez Díaz',
                'email' => 'msanchez@pge.gob.pe',
                'phone' => '987654327',
                'status' => 'active',
            ],
            [
                'name' => 'Carmen Julia Vega Morales',
                'email' => 'cvega@pge.gob.pe',
                'phone' => '987654328',
                'status' => 'active',
            ],
        ];

        $created = 0;
        foreach ($sectoristas as $sectoristaData) {
            if (!Sectorista::where('email', $sectoristaData['email'])->exists()) {
                Sectorista::create($sectoristaData);
                $created++;
            }
        }
        $this->command->info("   ✅ {$created} sectoristas creados");
    }
    
    /**
     * Seed implementation plan for production
     */
    private function seedImplementationPlan(): void
    {
        $this->command->info('📋 Creando plan de implementación...');
        
        // Verificar si ya existe un plan activo
        if (ImplementationPlan::where('status', 'active')->exists()) {
            $this->command->info("   ⚠️  Ya existe un plan activo, omitiendo...");
            return;
        }
        
        $user = User::first();
        
        $plan = ImplementationPlan::create([
            'resolution_type' => 'RM',
            'resolution_number' => 'RM-001-2025-PCM',
            'name' => 'PLAN DE IMPLEMENTACION',
            'description' => 'Plan de implementación para la transferencia de entidades a la Procuraduría General del Estado',
            'pdf_path' => null,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(6),
            'status' => 'active',
            'approved_by' => $user ? $user->id : null,
            'approved_at' => Carbon::now(),
        ]);
        
        $this->command->info("   ✅ Plan creado: {$plan->name}");
    }
}

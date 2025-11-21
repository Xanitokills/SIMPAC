<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sectorista;
use App\Models\Entity;
use App\Models\ImplementationPlan;
use App\Models\EntityAssignment;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProductionSeeder extends Seeder
{
    /**
     * Seed the application's database for production.
     * Crea los mismos datos que en desarrollo para que sea idéntico.
     */
    public function run(): void
    {
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('🌱 SIMPAC - Seeder de Producción (Datos Completos)');
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->newLine();

        // 1. Crear entidades primero (antes que sectoristas para las asignaciones)
        $this->command->info('🏢 Paso 1/5: Creando entidades...');
        $this->seedEntities();
        
        // 2. Crear sectoristas
        $this->command->info('👔 Paso 2/5: Creando sectoristas...');
        $this->seedSectoristas();
        
        // 3. Crear usuarios del sistema
        $this->command->info('👥 Paso 3/5: Creando usuarios...');
        $this->seedUsers();
        
        // 4. Crear plan de implementación
        $this->command->info('📋 Paso 4/5: Creando plan de implementación...');
        $this->seedImplementationPlan();
        
        // 5. Crear asignaciones de entidades
        $this->command->info('🔗 Paso 5/5: Creando asignaciones...');
        $this->seedEntityAssignments();

        $this->command->newLine();
        $this->command->info('═══════════════════════════════════════════════════════');
        $this->command->info('✅ Seeder de producción completado!');
        $this->command->info('   Total usuarios: ' . User::count());
        $this->command->info('   Total sectoristas: ' . Sectorista::count());
        $this->command->info('   Total entidades: ' . Entity::count());
        $this->command->info('   Total planes: ' . ImplementationPlan::count());
        $this->command->info('   Total asignaciones: ' . EntityAssignment::count());
        $this->command->info('═══════════════════════════════════════════════════════');
    }
    
    /**
     * Seed entities for production - Mismos datos que EntitySeeder
     */
    private function seedEntities(): void
    {
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
        $this->command->info("   ✅ {$created} entidades creadas (Total: " . Entity::count() . ")");
    }
    
    /**
     * Seed sectoristas for production - Mismos datos que SectoristaSeeder
     */
    private function seedSectoristas(): void
    {
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
        $this->command->info("   ✅ {$created} sectoristas creados (Total: " . Sectorista::count() . ")");
    }
    
    /**
     * Seed users for production - Mismos usuarios que en desarrollo
     */
    private function seedUsers(): void
    {
        $users = [
            // Admin
            ['name' => 'Administrador del Sistema', 'email' => 'admin@simpac.com', 'password' => 'admin123', 'role' => 'admin'],
            
            // Secretario CTPPGE
            ['name' => 'Carlos Mendoza Rivera', 'email' => 'secretario@simpac.com', 'password' => 'secretario123', 'role' => 'secretario_ctppge'],
            
            // Procurador PGE
            ['name' => 'Dra. María Elena Torres', 'email' => 'procurador@simpac.com', 'password' => 'procurador123', 'role' => 'procurador_pge'],
            
            // Responsable de Componente
            ['name' => 'Ing. Roberto Sánchez', 'email' => 'responsable@simpac.com', 'password' => 'responsable123', 'role' => 'responsable_componente'],
            
            // Órgano Colegiado
            ['name' => 'Comité de Validación', 'email' => 'colegiado@simpac.com', 'password' => 'colegiado123', 'role' => 'organo_colegiado'],
            
            // Sectoristas (usuarios con rol sectorista)
            ['name' => 'Juan Carlos Pérez', 'email' => 'juan.perez@simpac.com', 'password' => 'sectorista123', 'role' => 'sectorista'],
            ['name' => 'María Rodríguez', 'email' => 'maria.rodriguez@simpac.com', 'password' => 'sectorista123', 'role' => 'sectorista'],
            ['name' => 'Carlos Mendoza', 'email' => 'carlos.mendoza@simpac.com', 'password' => 'sectorista123', 'role' => 'sectorista'],
            
            // Usuario sectorista genérico
            ['name' => 'Sectorista de Prueba', 'email' => 'sectorista@simpac.com', 'password' => 'sectorista123', 'role' => 'sectorista'],
        ];

        $created = 0;
        foreach ($users as $userData) {
            if (!User::where('email', $userData['email'])->exists()) {
                User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role'],
                ]);
                $created++;
            }
        }
        $this->command->info("   ✅ {$created} usuarios creados (Total: " . User::count() . ")");
    }
    
    /**
     * Seed implementation plan for production
     */
    private function seedImplementationPlan(): void
    {
        // Verificar si ya existe un plan activo
        if (ImplementationPlan::where('status', 'active')->exists()) {
            $this->command->info("   ⚠️  Ya existe un plan activo (Total: " . ImplementationPlan::count() . ")");
            return;
        }
        
        $user = User::first();
        
        ImplementationPlan::create([
            'resolution_type' => 'RM',
            'resolution_number' => 'RM-001-2025-PCM',
            'name' => 'Plan de Transferencia PGE 2025',
            'description' => 'Plan de implementación para la transferencia de entidades a la Procuraduría General del Estado',
            'pdf_path' => 'plans/plan-2025.pdf',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(6),
            'status' => 'active',
            'approved_by' => $user ? $user->id : null,
            'approved_at' => Carbon::now(),
        ]);
        
        $this->command->info("   ✅ Plan de implementación creado");
    }
    
    /**
     * Seed entity assignments - Asignar entidades a sectoristas
     */
    private function seedEntityAssignments(): void
    {
        $plan = ImplementationPlan::where('status', 'active')->first();
        
        if (!$plan) {
            $this->command->warn("   ⚠️  No hay plan activo para crear asignaciones");
            return;
        }
        
        // Verificar si ya hay asignaciones
        if (EntityAssignment::where('implementation_plan_id', $plan->id)->exists()) {
            $this->command->info("   ⚠️  Ya existen asignaciones (Total: " . EntityAssignment::count() . ")");
            return;
        }
        
        $entities = Entity::all();
        $sectoristas = Sectorista::all();
        $user = User::first();
        
        if ($entities->isEmpty() || $sectoristas->isEmpty()) {
            $this->command->warn("   ⚠️  No hay entidades o sectoristas para crear asignaciones");
            return;
        }
        
        $created = 0;
        foreach ($entities as $index => $entity) {
            // Distribuir entidades entre sectoristas de forma circular
            $sectorista = $sectoristas[$index % $sectoristas->count()];
            
            EntityAssignment::create([
                'entity_id' => $entity->id,
                'sectorista_id' => $sectorista->id,
                'implementation_plan_id' => $plan->id,
                'assigned_at' => Carbon::now(),
                'status' => 'in_progress',
                'assigned_by' => $user ? $user->id : null,
                'notes' => "Asignación de {$entity->name} a {$sectorista->name}",
            ]);
            $created++;
        }
        
        $this->command->info("   ✅ {$created} asignaciones creadas");
    }
}

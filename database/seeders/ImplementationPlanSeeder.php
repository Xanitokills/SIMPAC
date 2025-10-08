<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImplementationPlan;
use App\Models\Entity;
use App\Models\Sectorista;
use App\Models\EntityAssignment;
use App\Models\User;
use Carbon\Carbon;

class ImplementationPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@simpac.gob.pe',
                'password' => bcrypt('password'),
            ]);
        }

        // Crear plan de implementación
        $plan = ImplementationPlan::create([
            'resolution_type' => 'RM',
            'resolution_number' => 'RM-001-2025-PCM',
            'name' => 'Plan de Transferencia PGE 2025',
            'description' => 'Plan de implementación para la transferencia de entidades a la Procuraduría General del Estado',
            'pdf_path' => 'plans/plan-2025.pdf',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(6),
            'status' => 'active',
            'approved_by' => $user->id,
            'approved_at' => Carbon::now(),
        ]);

        $this->command->info("Plan creado: {$plan->name}");

        // Obtener entidades y sectoristas
        $entities = Entity::all();
        $sectoristas = Sectorista::all();

        if ($entities->isEmpty() || $sectoristas->isEmpty()) {
            $this->command->warn('No hay entidades o sectoristas. Ejecuta sus seeders primero.');
            return;
        }

        // Asignar entidades a sectoristas
        $assignmentCount = 0;
        foreach ($entities as $index => $entity) {
            $sectorista = $sectoristas[$index % $sectoristas->count()];
            
            EntityAssignment::create([
                'entity_id' => $entity->id,
                'sectorista_id' => $sectorista->id,
                'implementation_plan_id' => $plan->id,
                'assigned_at' => Carbon::now(),
                'status' => 'in_progress',
                'assigned_by' => $user->id,
                'notes' => "Asignación de {$entity->name} a {$sectorista->name}",
            ]);
            
            $assignmentCount++;
        }

        $this->command->info("✓ Creadas {$assignmentCount} asignaciones de entidades");
    }
}

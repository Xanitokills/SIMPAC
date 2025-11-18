<?php

namespace Database\Seeders;

use App\Models\Oficio;
use App\Models\EntityAssignment;
use Illuminate\Database\Seeder;

class OficiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las asignaciones de entidades
        $assignments = EntityAssignment::all();

        if ($assignments->isEmpty()) {
            $this->command->warn('No hay asignaciones de entidades. Ejecuta primero el seeder de asignaciones.');
            return;
        }

        $oficioTypes = ['solicitud', 'respuesta', 'seguimiento'];
        $subjects = [
            'Solicitud de información sobre programas culturales',
            'Respuesta a solicitud de documentación',
            'Seguimiento a acuerdos de reunión',
            'Solicitud de cronograma de actividades',
            'Notificación de cambios en el proyecto',
            'Solicitud de reunión de coordinación',
            'Respuesta a observaciones del plan',
            'Seguimiento a compromisos adquiridos',
        ];

        foreach ($assignments as $assignment) {
            // Crear 2-4 oficios por entidad
            $numOficios = rand(2, 4);
            
            for ($i = 0; $i < $numOficios; $i++) {
                $issueDate = now()->subDays(rand(5, 60));
                $deadlineDate = $issueDate->copy()->addDays(rand(15, 45));
                
                Oficio::create([
                    'entity_assignment_id' => $assignment->id,
                    'type' => $oficioTypes[array_rand($oficioTypes)],
                    'subject' => $subjects[array_rand($subjects)],
                    'description' => 'Se solicita la información correspondiente para el seguimiento del proyecto SIMPAC. Es importante contar con esta documentación para continuar con el proceso de implementación.',
                    'oficio_number' => 'SIMPAC-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT),
                    'issue_date' => $issueDate,
                    'deadline_date' => $deadlineDate,
                    'status' => ['pending', 'in_progress', 'completed'][array_rand(['pending', 'in_progress', 'completed'])],
                    'created_by' => $assignment->sectorista->user_id ?? 1,
                ]);
            }
        }

        $this->command->info('Oficios de ejemplo creados exitosamente.');
    }
}

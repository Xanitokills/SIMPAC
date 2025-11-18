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

        $oficioTypes = ['solicitud', 'reiteracion'];
        $subjects = [
            'Solicitud de información sobre programas culturales',
            'Solicitud de documentación del proyecto',
            'Solicitud de cronograma de actividades',
            'Solicitud de reunión de coordinación',
            'Reiteración de solicitud anterior',
            'Solicitud de avances del plan',
            'Solicitud de evidencias documentales',
            'Solicitud de confirmación de asistencia',
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
                    'status' => ['pendiente', 'cumplido', 'vencido'][array_rand(['pendiente', 'cumplido', 'vencido'])],
                    'created_by' => $assignment->sectorista->user_id ?? 1,
                ]);
            }
        }

        $this->command->info('Oficios de ejemplo creados exitosamente.');
    }
}

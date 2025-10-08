<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meeting;
use App\Models\MeetingHistory;
use App\Models\MeetingAgreement;
use App\Models\Oficio;
use App\Models\ActoResolutivo;
use App\Models\InductionSession;
use App\Models\EntityAssignment;
use App\Models\User;
use Carbon\Carbon;

class Activity2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Obtener asignaciones existentes
        $assignments = EntityAssignment::with(['entity', 'sectorista'])->get();

        if ($assignments->isEmpty()) {
            $this->command->warn('No hay asignaciones de entidades. Ejecuta EntitySeeder primero.');
            return;
        }

        foreach ($assignments->take(3) as $assignment) {
            $this->command->info("Creando datos para: {$assignment->entity->name}");

            // Crear reuniones
            for ($i = 1; $i <= 3; $i++) {
                $meeting = Meeting::create([
                    'entity_assignment_id' => $assignment->id,
                    'contact_name' => 'Juan Pérez',
                    'contact_email' => 'juan.perez@' . strtolower(str_replace(' ', '', $assignment->entity->name)) . '.gob.pe',
                    'contact_phone' => '999888777',
                    'subject' => "Coordinación {$i} - Conformación Órgano Colegiado",
                    'scheduled_date' => Carbon::now()->addDays($i * 7),
                    'meeting_link' => 'https://meet.google.com/' . uniqid(),
                    'status' => $i === 1 ? 'completed' : 'scheduled',
                    'conclusion' => $i === 1 ? 'Se acordó iniciar el proceso de conformación del órgano colegiado.' : null,
                    'notes' => "Reunión {$i} para coordinar la conformación del órgano colegiado.",
                ]);

                // Historial
                MeetingHistory::create([
                    'meeting_id' => $meeting->id,
                    'subject' => $meeting->subject,
                    'scheduled_date' => $meeting->scheduled_date,
                    'meeting_link' => $meeting->meeting_link,
                    'change_type' => 'created',
                    'changed_by' => $user->id,
                ]);

                // Acuerdos si la reunión está completada
                if ($meeting->status === 'completed') {
                    MeetingAgreement::create([
                        'meeting_id' => $meeting->id,
                        'agreement' => 'Remitir lista de posibles miembros del órgano colegiado',
                        'deadline_date' => Carbon::now()->addDays(15),
                        'status' => 'pendiente',
                    ]);

                    MeetingAgreement::create([
                        'meeting_id' => $meeting->id,
                        'agreement' => 'Preparar documentación legal necesaria',
                        'deadline_date' => Carbon::now()->addDays(20),
                        'status' => 'en_progreso',
                    ]);
                }
            }

            // Crear oficios
            $oficio = Oficio::create([
                'entity_assignment_id' => $assignment->id,
                'type' => 'solicitud',
                'subject' => 'Solicitud de Conformación del Órgano Colegiado',
                'description' => 'Se solicita la conformación del Órgano Colegiado para el proceso de transferencia a la PGE.',
                'deadline_date' => Carbon::now()->addDays(30),
                'issue_date' => Carbon::now(),
                'oficio_number' => 'OF-' . str_pad($assignment->id, 4, '0', STR_PAD_LEFT) . '-2025',
                'status' => 'pendiente',
                'created_by' => $user->id,
            ]);

            $this->command->info("  ✓ Creadas 3 reuniones y 1 oficio");
        }

        // Crear un oficio cumplido con acto resolutivo para el primer assignment
        $firstAssignment = $assignments->first();
        $oficioCompleto = Oficio::create([
            'entity_assignment_id' => $firstAssignment->id,
            'type' => 'solicitud',
            'subject' => 'Solicitud de Conformación del Órgano Colegiado - Expediente Completo',
            'description' => 'Solicitud con respuesta favorable.',
            'deadline_date' => Carbon::now()->subDays(5),
            'issue_date' => Carbon::now()->subDays(35),
            'oficio_number' => 'OF-0001-2025',
            'status' => 'cumplido',
            'created_by' => $user->id,
        ]);

        ActoResolutivo::create([
            'oficio_id' => $oficioCompleto->id,
            'resolution_number' => 'RES-001-2025-' . strtoupper(substr($firstAssignment->entity->name, 0, 3)),
            'resolution_date' => Carbon::now()->subDays(2),
            'document_path' => 'actos-resolutivos/ejemplo.pdf',
            'notes' => 'Resolución aprobando la conformación del órgano colegiado.',
            'uploaded_by' => $user->id,
        ]);

        // Crear sesión de inducción
        InductionSession::create([
            'entity_assignment_id' => $firstAssignment->id,
            'acto_resolutivo_id' => 1,
            'subject' => 'Sesión de Inducción - Pautas y Plan de Acción',
            'session_date' => Carbon::now()->addDays(10),
            'meeting_link' => 'https://meet.google.com/' . uniqid(),
            'guidelines' => 'Se presentarán las pautas generales para el funcionamiento del órgano colegiado.',
            'action_plan' => 'Plan de trabajo trimestral con objetivos específicos.',
            'status' => 'scheduled',
            'created_by' => $user->id,
        ]);

        $this->command->info('✓ Datos de prueba creados exitosamente para Actividad 2');
    }
}

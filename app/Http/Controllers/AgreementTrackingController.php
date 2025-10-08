<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\MeetingAgreement;
use Illuminate\Http\Request;

class AgreementTrackingController extends Controller
{
    /**
     * Mostrar panel de seguimiento de acuerdos
     */
    public function index($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        // Obtener todos los acuerdos de las reuniones de esta asignación
        $agreements = MeetingAgreement::whereHas('meeting', function($query) use ($assignmentId) {
            $query->where('entity_assignment_id', $assignmentId);
        })
        ->with('meeting')
        ->orderBy('deadline_date', 'asc')
        ->get();

        // Actualizar estados automáticamente
        foreach ($agreements as $agreement) {
            $agreement->checkAndUpdateStatus();
        }

        // Agrupar por estado
        $pendientes = $agreements->where('status', 'pendiente');
        $enProgreso = $agreements->where('status', 'en_progreso');
        $cumplidos = $agreements->where('status', 'cumplido');
        $vencidos = $agreements->where('status', 'vencido');

        return view('agreements.tracking', compact(
            'assignment',
            'agreements',
            'pendientes',
            'enProgreso',
            'cumplidos',
            'vencidos'
        ));
    }

    /**
     * Panel de seguimiento visual (Kanban)
     */
    public function kanban($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        $agreements = MeetingAgreement::whereHas('meeting', function($query) use ($assignmentId) {
            $query->where('entity_assignment_id', $assignmentId);
        })
        ->with('meeting')
        ->get();

        // Actualizar estados
        foreach ($agreements as $agreement) {
            $agreement->checkAndUpdateStatus();
        }

        return view('agreements.kanban', compact('assignment', 'agreements'));
    }

    /**
     * Actualizar estado de acuerdo desde el panel
     */
    public function updateStatus(Request $request, $agreementId)
    {
        $agreement = MeetingAgreement::findOrFail($agreementId);

        $validated = $request->validate([
            'status' => 'required|in:pendiente,en_progreso,cumplido,vencido',
            'notes' => 'nullable|string',
        ]);

        $agreement->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado correctamente.',
            'agreement' => $agreement->fresh()
        ]);
    }

    /**
     * Dashboard de todas las asignaciones del sectorista
     */
    public function dashboard($sectoristaId)
    {
        $assignments = EntityAssignment::where('sectorista_id', $sectoristaId)
            ->with(['entity', 'meetings.agreements'])
            ->get();

        $allAgreements = MeetingAgreement::whereHas('meeting.entityAssignment', function($query) use ($sectoristaId) {
            $query->where('sectorista_id', $sectoristaId);
        })
        ->with('meeting.entityAssignment.entity')
        ->get();

        // Actualizar estados
        foreach ($allAgreements as $agreement) {
            $agreement->checkAndUpdateStatus();
        }

        // Estadísticas
        $stats = [
            'total' => $allAgreements->count(),
            'pendientes' => $allAgreements->where('status', 'pendiente')->count(),
            'en_progreso' => $allAgreements->where('status', 'en_progreso')->count(),
            'cumplidos' => $allAgreements->where('status', 'cumplido')->count(),
            'vencidos' => $allAgreements->where('status', 'vencido')->count(),
        ];

        return view('agreements.dashboard', compact('assignments', 'allAgreements', 'stats'));
    }
}

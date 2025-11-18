<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\Meeting;
use App\Models\Sectorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExecutionMeetingController extends Controller
{
    /**
     * Listado de reuniones de coordinación en fase de ejecución
     */
    public function index()
    {
        $meetings = Meeting::with(['entityAssignment.entity', 'entityAssignment.sectorista'])
            ->where('meeting_type', 'coordination')
            ->orderBy('scheduled_date', 'desc')
            ->paginate(15);

        return view('dashboard.execution.meetings.index', compact('meetings'));
    }

    /**
     * Mostrar formulario para crear reunión de coordinación
     */
    public function create(Request $request)
    {
        // Si viene assignment_id por parámetro, usar solo esa asignación
        $assignmentId = $request->query('assignment');
        
        if ($assignmentId) {
            $assignment = EntityAssignment::with(['entity', 'sectorista'])
                ->findOrFail($assignmentId);
            
            return view('dashboard.execution.meetings.create', [
                'assignment' => $assignment,
                'assignments' => null,
                'sectoristas' => null
            ]);
        }
        
        // Si no viene assignment_id, mostrar todas las asignaciones disponibles
        $assignments = EntityAssignment::with(['entity', 'sectorista'])
            ->where('status', 'active')
            ->get();

        $sectoristas = Sectorista::all();

        return view('dashboard.execution.meetings.create', [
            'assignment' => null,
            'assignments' => $assignments,
            'sectoristas' => $sectoristas
        ]);
    }

    /**
     * Guardar nueva reunión de coordinación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'entity_assignment_id' => 'required|exists:entity_assignments,id',
            'subject' => 'required|string|max:255',
            'scheduled_date' => 'required|date|after:now',
            'meeting_link' => 'nullable|url|max:500',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'agenda' => 'nullable|string',
            'components' => 'nullable|array',
            'components.*' => 'string|in:presupuesto,bienes,acervo,tecnologia,rrhh',
            'notes' => 'nullable|string',
        ]);

        $validated['meeting_type'] = 'coordination';
        $validated['status'] = 'scheduled';
        $validated['components'] = json_encode($request->components ?? []);

        $meeting = Meeting::create($validated);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión de coordinación programada exitosamente.');
    }

    /**
     * Mostrar detalle de reunión de coordinación
     */
    public function show($id)
    {
        $meeting = Meeting::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'agreements',
            'actionPlan.items'
        ])->findOrFail($id);

        // Decodificar componentes
        $meeting->components_array = json_decode($meeting->components, true) ?? [];

        return view('dashboard.execution.meetings.show', compact('meeting'));
    }

    /**
     * Mostrar formulario para editar reunión
     */
    public function edit($id)
    {
        $meeting = Meeting::with('entityAssignment.entity')->findOrFail($id);
        
        $assignments = EntityAssignment::with(['entity', 'sectorista'])
            ->where('status', 'active')
            ->get();

        $meeting->components_array = json_decode($meeting->components, true) ?? [];

        return view('dashboard.execution.meetings.edit', compact('meeting', 'assignments'));
    }

    /**
     * Actualizar reunión de coordinación
     */
    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'meeting_type' => 'required|string|in:coordination,presentation,follow_up',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'participants' => 'nullable|string',
            'outcome' => 'nullable|string',
        ]);

        // Combinar fecha y hora
        $meetingDateTime = $validated['meeting_date'] . ' ' . $validated['meeting_time'];
        unset($validated['meeting_date'], $validated['meeting_time']);
        $validated['meeting_date'] = $meetingDateTime;

        $meeting->update($validated);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión actualizada exitosamente.');
    }

    /**
     * Marcar reunión como completada
     */
    public function complete(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $meeting->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión marcada como completada. Ahora puede registrar el plan de acción aprobado.');
    }

    /**
     * Cancelar reunión
     */
    public function cancel(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $meeting->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión cancelada.');
    }
}

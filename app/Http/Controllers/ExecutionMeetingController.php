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
    public function create()
    {
        // Obtener todas las asignaciones disponibles para seleccionar
        $assignments = EntityAssignment::with(['entity', 'sectorista'])
            ->where('status', 'active')
            ->get();

        $sectoristas = Sectorista::all();

        return view('dashboard.execution.meetings.create', compact('assignments', 'sectoristas'));
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
            'agreements'
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
            'subject' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'meeting_link' => 'nullable|url|max:500',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'agenda' => 'nullable|string',
            'components' => 'nullable|array',
            'components.*' => 'string|in:presupuesto,bienes,acervo,tecnologia,rrhh',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $validated['components'] = json_encode($request->components ?? []);

        $meeting->update($validated);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión actualizada exitosamente.');
    }

    /**
     * Marcar reunión como completada con acta
     */
    public function complete(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'actual_date' => 'required|date',
            'attendees' => 'required|string',
            'minutes' => 'required|string',
            'proposal_presented' => 'required|boolean',
            'proposal_document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'agreements_reached' => 'nullable|string',
        ]);

        // Subir documento de propuesta si existe
        if ($request->hasFile('proposal_document')) {
            $path = $request->file('proposal_document')->store('execution/proposals', 'public');
            $validated['proposal_document_path'] = $path;
        }

        $meeting->update([
            'status' => 'completed',
            'actual_date' => $validated['actual_date'],
            'attendees' => $validated['attendees'],
            'minutes' => $validated['minutes'],
            'proposal_presented' => $validated['proposal_presented'],
            'proposal_document_path' => $validated['proposal_document_path'] ?? null,
            'agreements_reached' => $validated['agreements_reached'] ?? null,
        ]);

        return redirect()
            ->route('execution.meetings.show', $meeting->id)
            ->with('success', 'Reunión completada y acta registrada exitosamente.');
    }

    /**
     * Cancelar reunión
     */
    public function cancel(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        $meeting->update([
            'status' => 'cancelled',
            'cancellation_reason' => $validated['cancellation_reason'],
        ]);

        return redirect()
            ->route('execution.meetings.index')
            ->with('success', 'Reunión cancelada.');
    }
}

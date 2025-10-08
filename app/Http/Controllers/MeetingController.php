<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\Meeting;
use App\Models\MeetingHistory;
use App\Models\MeetingAgreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Listar reuniones de una asignación
     */
    public function index($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista', 'meetings.agreements'])
            ->findOrFail($assignmentId);
        
        $meetings = $assignment->meetings()
            ->with('agreements')
            ->orderBy('scheduled_date', 'desc')
            ->paginate(10);

        return view('meetings.index', compact('assignment', 'meetings'));
    }

    /**
     * Mostrar formulario para crear reunión
     */
    public function create($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        return view('meetings.create', compact('assignment'));
    }

    /**
     * Guardar nueva reunión
     */
    public function store(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'scheduled_date' => 'required|date|after:now',
            'meeting_link' => 'nullable|url|max:500',
            'notes' => 'nullable|string',
        ]);

        $validated['entity_assignment_id'] = $assignmentId;
        $validated['status'] = 'scheduled';

        $meeting = Meeting::create($validated);

        // Registrar en historial
        MeetingHistory::create([
            'meeting_id' => $meeting->id,
            'subject' => $meeting->subject,
            'scheduled_date' => $meeting->scheduled_date,
            'meeting_link' => $meeting->meeting_link,
            'change_type' => 'created',
            'changed_by' => Auth::id(),
        ]);

        return redirect()
            ->route('meetings.show', $meeting->id)
            ->with('success', 'Reunión programada exitosamente.');
    }

    /**
     * Mostrar detalle de reunión
     */
    public function show($id)
    {
        $meeting = Meeting::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'history.changedBy',
            'agreements'
        ])->findOrFail($id);

        return view('meetings.show', compact('meeting'));
    }

    /**
     * Mostrar formulario para reprogramar
     */
    public function edit($id)
    {
        $meeting = Meeting::with('entityAssignment.entity')->findOrFail($id);

        return view('meetings.edit', compact('meeting'));
    }

    /**
     * Reprogramar reunión
     */
    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'meeting_link' => 'nullable|url|max:500',
            'notes' => 'nullable|string',
            'reason' => 'required|string|max:500',
        ]);

        $changeType = 'rescheduled';
        if ($meeting->subject !== $validated['subject']) {
            $changeType = 'subject_changed';
        }

        // Registrar cambio en historial
        MeetingHistory::create([
            'meeting_id' => $meeting->id,
            'subject' => $validated['subject'],
            'scheduled_date' => $validated['scheduled_date'],
            'meeting_link' => $validated['meeting_link'],
            'change_type' => $changeType,
            'reason' => $validated['reason'],
            'changed_by' => Auth::id(),
        ]);

        // Actualizar reunión
        $meeting->update([
            'contact_name' => $validated['contact_name'],
            'contact_email' => $validated['contact_email'],
            'contact_phone' => $validated['contact_phone'],
            'subject' => $validated['subject'],
            'scheduled_date' => $validated['scheduled_date'],
            'meeting_link' => $validated['meeting_link'],
            'notes' => $validated['notes'],
            'status' => 'rescheduled',
        ]);

        return redirect()
            ->route('meetings.show', $meeting->id)
            ->with('success', 'Reunión reprogramada exitosamente.');
    }

    /**
     * Completar reunión con conclusión
     */
    public function complete(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $validated = $request->validate([
            'conclusion' => 'required|string',
        ]);

        $meeting->update([
            'conclusion' => $validated['conclusion'],
            'status' => 'completed',
        ]);

        // Registrar en historial
        MeetingHistory::create([
            'meeting_id' => $meeting->id,
            'subject' => $meeting->subject,
            'scheduled_date' => $meeting->scheduled_date,
            'meeting_link' => $meeting->meeting_link,
            'change_type' => 'completed',
            'changed_by' => Auth::id(),
        ]);

        return redirect()
            ->route('meetings.show', $meeting->id)
            ->with('success', 'Reunión completada exitosamente.');
    }

    /**
     * Ver historial de cambios
     */
    public function history($id)
    {
        $meeting = Meeting::with([
            'history.changedBy',
            'entityAssignment.entity'
        ])->findOrFail($id);

        return view('meetings.history', compact('meeting'));
    }

    /**
     * Agregar acuerdo a una reunión
     */
    public function addAgreement(Request $request, $id)
    {
        $validated = $request->validate([
            'agreement' => 'required|string',
            'deadline_date' => 'nullable|date|after:today',
            'notes' => 'nullable|string',
        ]);

        $validated['meeting_id'] = $id;
        $validated['status'] = 'pendiente';

        MeetingAgreement::create($validated);

        return back()->with('success', 'Acuerdo agregado exitosamente.');
    }

    /**
     * Actualizar estado de acuerdo
     */
    public function updateAgreementStatus(Request $request, $meetingId, $agreementId)
    {
        $agreement = MeetingAgreement::where('meeting_id', $meetingId)
            ->findOrFail($agreementId);

        $validated = $request->validate([
            'status' => 'required|in:pendiente,en_progreso,cumplido,vencido',
            'notes' => 'nullable|string',
        ]);

        $agreement->update($validated);

        return back()->with('success', 'Estado del acuerdo actualizado.');
    }
}

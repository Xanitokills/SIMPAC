<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\InductionSession;
use App\Models\ActoResolutivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InductionSessionController extends Controller
{
    /**
     * Listar sesiones de inducción
     */
    public function index($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);
        
        $sessions = $assignment->inductionSessions()
            ->with('actoResolutivo')
            ->orderBy('session_date', 'desc')
            ->paginate(10);

        return view('induction-sessions.index', compact('assignment', 'sessions'));
    }

    /**
     * Mostrar formulario para crear sesión
     */
    public function create($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista', 'oficios.actoResolutivo'])
            ->findOrFail($assignmentId);

        // Obtener actos resolutivos disponibles
        $actosResolutivos = ActoResolutivo::whereHas('oficio', function($query) use ($assignmentId) {
            $query->where('entity_assignment_id', $assignmentId);
        })->get();

        return view('induction-sessions.create', compact('assignment', 'actosResolutivos'));
    }

    /**
     * Guardar nueva sesión
     */
    public function store(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'acto_resolutivo_id' => 'nullable|exists:actos_resolutivos,id',
            'subject' => 'required|string|max:255',
            'session_date' => 'required|date|after:now',
            'meeting_link' => 'nullable|url|max:500',
            'guidelines' => 'nullable|string',
            'action_plan' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated['entity_assignment_id'] = $assignmentId;
        $validated['status'] = 'scheduled';
        $validated['created_by'] = Auth::id();

        $session = InductionSession::create($validated);

        return redirect()
            ->route('induction-sessions.show', $session->id)
            ->with('success', 'Sesión de inducción programada exitosamente.');
    }

    /**
     * Mostrar detalle de sesión
     */
    public function show($id)
    {
        $session = InductionSession::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'actoResolutivo.oficio',
            'creator'
        ])->findOrFail($id);

        return view('induction-sessions.show', compact('session'));
    }

    /**
     * Mostrar formulario para editar
     */
    public function edit($id)
    {
        $session = InductionSession::with('entityAssignment.entity')->findOrFail($id);

        $actosResolutivos = ActoResolutivo::whereHas('oficio', function($query) use ($session) {
            $query->where('entity_assignment_id', $session->entity_assignment_id);
        })->get();

        return view('induction-sessions.edit', compact('session', 'actosResolutivos'));
    }

    /**
     * Actualizar sesión
     */
    public function update(Request $request, $id)
    {
        $session = InductionSession::findOrFail($id);

        $validated = $request->validate([
            'acto_resolutivo_id' => 'nullable|exists:actos_resolutivos,id',
            'subject' => 'required|string|max:255',
            'session_date' => 'required|date',
            'meeting_link' => 'nullable|url|max:500',
            'guidelines' => 'nullable|string',
            'action_plan' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $session->update($validated);

        return redirect()
            ->route('induction-sessions.show', $session->id)
            ->with('success', 'Sesión actualizada exitosamente.');
    }

    /**
     * Marcar sesión como completada
     */
    public function complete(Request $request, $id)
    {
        $session = InductionSession::findOrFail($id);

        $validated = $request->validate([
            'guidelines' => 'required|string',
            'action_plan' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $session->update([
            'guidelines' => $validated['guidelines'],
            'action_plan' => $validated['action_plan'],
            'notes' => $validated['notes'] ?? $session->notes,
            'status' => 'completed',
        ]);

        return redirect()
            ->route('induction-sessions.show', $session->id)
            ->with('success', 'Sesión completada exitosamente.');
    }

    /**
     * Cancelar sesión
     */
    public function cancel(Request $request, $id)
    {
        $session = InductionSession::findOrFail($id);

        $validated = $request->validate([
            'notes' => 'required|string',
        ]);

        $session->update([
            'notes' => $validated['notes'],
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route('induction-sessions.index', $session->entity_assignment_id)
            ->with('info', 'Sesión cancelada.');
    }
}

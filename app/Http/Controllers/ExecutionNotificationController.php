<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\Oficio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExecutionNotificationController extends Controller
{
    /**
     * Listado de notificaciones y seguimiento de respuestas
     */
    public function index(Request $request)
    {
        $query = Oficio::with(['entityAssignment.entity', 'entityAssignment.sectorista']);

        // Filtros
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('entityAssignment', function($q) use ($search) {
                $q->whereHas('entity', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('sectorista', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('notification_status', $request->status);
        }

        $notifications = $query->orderBy('deadline_date', 'asc')->paginate(15);

        // Estadísticas
        $stats = [
            'overdue' => Oficio::where('notification_status', 'overdue')->count(),
            'pending' => Oficio::where('notification_status', 'pending')->count(),
            'notified' => Oficio::where('notification_status', 'notified')->count(),
            'completed' => Oficio::where('notification_status', 'completed')->count(),
            'near_deadline' => Oficio::where('notification_status', 'pending')
                ->whereBetween('deadline_date', [now(), now()->addDays(3)])
                ->count(),
        ];

        return view('dashboard.execution.notifications.index', compact('notifications', 'stats'));
    }

    /**
     * Mostrar formulario para crear notificación
     */
    public function create(Request $request)
    {
        // Si viene assignment_id por parámetro, usar solo esa asignación
        $assignmentId = $request->query('assignment');
        
        if ($assignmentId) {
            $assignment = EntityAssignment::with(['entity', 'sectorista'])
                ->findOrFail($assignmentId);
            
            $oficios = Oficio::with('entityAssignment.entity')
                ->where('entity_assignment_id', $assignmentId)
                ->whereIn('status', ['sent', 'pending_response'])
                ->get();
            
            return view('dashboard.execution.notifications.create', [
                'assignment' => $assignment,
                'assignments' => null,
                'oficios' => $oficios
            ]);
        }
        
        // Si no viene assignment_id, mostrar todas las asignaciones disponibles
        $assignments = EntityAssignment::with(['entity', 'sectorista'])
            ->where('status', 'active')
            ->get();

        $oficios = Oficio::with('entityAssignment.entity')
            ->whereIn('status', ['sent', 'pending_response'])
            ->get();

        return view('dashboard.execution.notifications.create', [
            'assignment' => null,
            'assignments' => $assignments,
            'oficios' => $oficios
        ]);
    }

    /**
     * Guardar nueva notificación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'oficio_id' => 'required|exists:oficios,id',
            'notification_type' => 'required|in:reminder,escalation,final_notice',
            'notification_date' => 'required|date',
            'message' => 'required|string',
            'evidence_required' => 'boolean',
            'evidence_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $oficio = Oficio::findOrFail($validated['oficio_id']);

        // Actualizar contador de notificaciones
        $oficio->increment('notification_count');
        
        // Actualizar estado según el tipo de notificación
        if ($validated['notification_type'] === 'final_notice') {
            $oficio->update(['notification_status' => 'final_notice_sent']);
        } else {
            $oficio->update(['notification_status' => 'notified']);
        }

        // Guardar evidencias si existen
        $evidencePaths = [];
        if ($request->hasFile('evidence_documents')) {
            foreach ($request->file('evidence_documents') as $file) {
                $path = $file->store('execution/notifications/evidence', 'public');
                $evidencePaths[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'uploaded_at' => now(),
                ];
            }
        }

        // Crear registro de notificación (puedes crear una tabla separada si lo prefieres)
        $notificationData = array_merge($validated, [
            'evidence_paths' => json_encode($evidencePaths),
            'created_by' => Auth::id(),
            'sent_at' => now(),
        ]);

        // Guardar en una tabla de notificaciones o en el oficio
        $oficio->update([
            'last_notification_date' => $validated['notification_date'],
            'last_notification_type' => $validated['notification_type'],
            'notification_message' => $validated['message'],
            'notification_evidence' => json_encode($evidencePaths),
        ]);

        return redirect()
            ->route('execution.notifications.show', $oficio->id)
            ->with('success', 'Notificación enviada y evidencia registrada exitosamente.');
    }

    /**
     * Mostrar detalle de notificación
     */
    public function show($id)
    {
        $notification = Oficio::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'actoResolutivo'
        ])->findOrFail($id);

        // Decodificar evidencias
        $notification->evidence_array = json_decode($notification->notification_evidence, true) ?? [];

        return view('dashboard.execution.notifications.show', compact('notification'));
    }

    /**
     * Adjuntar evidencia de seguimiento
     */
    public function attachEvidence(Request $request, $id)
    {
        $oficio = Oficio::findOrFail($id);

        $validated = $request->validate([
            'evidence_type' => 'required|in:email,document,screenshot,other',
            'evidence_description' => 'required|string',
            'evidence_files.*' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $evidencePaths = [];
        if ($request->hasFile('evidence_files')) {
            foreach ($request->file('evidence_files') as $file) {
                $path = $file->store('execution/notifications/evidence', 'public');
                $evidencePaths[] = [
                    'type' => $validated['evidence_type'],
                    'description' => $validated['evidence_description'],
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'uploaded_at' => now(),
                    'uploaded_by' => Auth::id(),
                ];
            }
        }

        // Agregar a las evidencias existentes
        $existingEvidence = json_decode($oficio->notification_evidence, true) ?? [];
        $allEvidence = array_merge($existingEvidence, $evidencePaths);

        $oficio->update([
            'notification_evidence' => json_encode($allEvidence),
        ]);

        return redirect()
            ->route('execution.notifications.show', $oficio->id)
            ->with('success', 'Evidencia adjuntada exitosamente.');
    }

    /**
     * Marcar como respondido
     */
    public function markAsResponded(Request $request, $id)
    {
        $oficio = Oficio::findOrFail($id);

        $validated = $request->validate([
            'response_date' => 'required|date',
            'response_summary' => 'required|string',
            'response_documents.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $responsePaths = [];
        if ($request->hasFile('response_documents')) {
            foreach ($request->file('response_documents') as $file) {
                $path = $file->store('execution/notifications/responses', 'public');
                $responsePaths[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                ];
            }
        }

        $oficio->update([
            'notification_status' => 'completed',
            'response_received_date' => $validated['response_date'],
            'response_summary' => $validated['response_summary'],
            'response_documents' => json_encode($responsePaths),
        ]);

        return redirect()
            ->route('execution.notifications.show', $oficio->id)
            ->with('success', 'Respuesta registrada exitosamente.');
    }

    /**
     * Descargar evidencia
     */
    public function downloadEvidence($id, $evidenceIndex)
    {
        $oficio = Oficio::findOrFail($id);
        $evidence = json_decode($oficio->notification_evidence, true) ?? [];

        if (!isset($evidence[$evidenceIndex])) {
            abort(404, 'Evidencia no encontrada');
        }

        $evidenceFile = $evidence[$evidenceIndex];
        $path = $evidenceFile['path'];

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Archivo no encontrado');
        }

        return Storage::disk('public')->download($path, $evidenceFile['name']);
    }

    /**
     * Actualizar estado de notificación
     */
    public function updateStatus(Request $request, $id)
    {
        $oficio = Oficio::findOrFail($id);

        $validated = $request->validate([
            'notification_status' => 'required|in:pending,notified,responded,overdue,completed',
            'status_note' => 'nullable|string',
        ]);

        $oficio->update($validated);

        return redirect()
            ->route('execution.notifications.show', $oficio->id)
            ->with('success', 'Estado actualizado exitosamente.');
    }
}

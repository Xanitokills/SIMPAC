<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\Oficio;
use App\Models\ActoResolutivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OficioController extends Controller
{
    /**
     * Listar oficios de una asignación
     */
    public function index($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);
        
        $oficios = $assignment->oficios()
            ->with('actoResolutivo')
            ->orderBy('issue_date', 'desc')
            ->paginate(10);

        // Actualizar estados vencidos
        foreach ($oficios as $oficio) {
            $oficio->checkAndUpdateStatus();
        }

        return view('oficios.index', compact('assignment', 'oficios'));
    }

    /**
     * Mostrar formulario para crear oficio
     */
    public function create($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        return view('oficios.create', compact('assignment'));
    }

    /**
     * Guardar nuevo oficio
     */
    public function store(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'type' => 'required|in:solicitud,reiteracion',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline_date' => 'required|date|after:today',
            'issue_date' => 'required|date',
            'oficio_number' => 'nullable|string|max:100',
        ]);

        $validated['entity_assignment_id'] = $assignmentId;
        $validated['status'] = 'pendiente';
        $validated['created_by'] = Auth::id();

        $oficio = Oficio::create($validated);

        return redirect()
            ->route('oficios.show', $oficio->id)
            ->with('success', 'Oficio registrado exitosamente.');
    }

    /**
     * Mostrar detalle de oficio
     */
    public function show($id)
    {
        $oficio = Oficio::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'actoResolutivo.uploader',
            'creator'
        ])->findOrFail($id);

        $oficio->checkAndUpdateStatus();

        return view('oficios.show', compact('oficio'));
    }

    /**
     * Crear oficio de reiteración
     */
    public function createReiteration($oficioId)
    {
        $originalOficio = Oficio::with('entityAssignment.entity')->findOrFail($oficioId);

        return view('oficios.create-reiteration', compact('originalOficio'));
    }

    /**
     * Subir acto resolutivo
     */
    public function uploadActoResolutivo(Request $request, $id)
    {
        $oficio = Oficio::findOrFail($id);

        $validated = $request->validate([
            'resolution_number' => 'required|string|max:100',
            'resolution_date' => 'required|date',
            'document' => 'required|file|mimes:pdf|max:10240',
            'notes' => 'nullable|string',
        ]);

        // Subir documento
        $path = $request->file('document')->store('actos-resolutivos', 'public');

        ActoResolutivo::create([
            'oficio_id' => $oficio->id,
            'resolution_number' => $validated['resolution_number'],
            'resolution_date' => $validated['resolution_date'],
            'document_path' => $path,
            'notes' => $validated['notes'] ?? null,
            'uploaded_by' => Auth::id(),
        ]);

        // Actualizar estado del oficio
        $oficio->update(['status' => 'cumplido']);

        return redirect()
            ->route('oficios.show', $oficio->id)
            ->with('success', 'Acto resolutivo registrado exitosamente.');
    }

    /**
     * Descargar documento del acto resolutivo
     */
    public function downloadActoResolutivo($oficioId)
    {
        $oficio = Oficio::with('actoResolutivo')->findOrFail($oficioId);

        if (!$oficio->actoResolutivo) {
            abort(404, 'No se encontró el acto resolutivo.');
        }

        return Storage::disk('public')->download(
            $oficio->actoResolutivo->document_path,
            'Acto_Resolutivo_' . $oficio->actoResolutivo->resolution_number . '.pdf'
        );
    }

    /**
     * Generar documento del oficio (PDF)
     */
    public function generateDocument($id)
    {
        $oficio = Oficio::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'creator'
        ])->findOrFail($id);

        return view('oficios.document', compact('oficio'));
    }
}

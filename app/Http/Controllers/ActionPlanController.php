<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\ActionPlanItem;
use App\Models\ActionPlanTemplate;
use App\Models\EntityAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActionPlanController extends Controller
{
    /**
     * Mostrar formulario para crear plan de acción
     */
    public function create($assignmentId)
    {
        $assignment = EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        // Verificar si ya existe un plan de acción
        if ($assignment->actionPlan) {
            return redirect()
                ->route('execution.action-plans.show', $assignment->actionPlan->id)
                ->with('info', 'Esta entidad ya tiene un plan de acción registrado.');
        }

        return view('dashboard.execution.action-plans.create', compact('assignment'));
    }

    /**
     * Guardar nuevo plan de acción
     */
    public function store(Request $request, $assignmentId)
    {
        $assignment = EntityAssignment::findOrFail($assignmentId);

        // Verificar si ya existe un plan de acción
        if ($assignment->actionPlan) {
            return redirect()
                ->route('execution.action-plans.show', $assignment->actionPlan->id)
                ->with('error', 'Esta entidad ya tiene un plan de acción registrado.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'approval_date' => 'required|date',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.action_name' => 'required|string|max:255',
            'items.*.description' => 'required|string',
            'items.*.responsible' => 'required|string|max:255',
            'items.*.predecessor_action' => 'nullable|string|max:255',
            'items.*.start_date' => 'nullable|date',
            'items.*.end_date' => 'required|date',
            'items.*.business_days' => 'nullable|integer',
            'items.*.status' => 'required|in:pendiente,proceso,finalizado',
            'items.*.comments' => 'nullable|string',
            'items.*.problems' => 'nullable|string',
            'items.*.corrective_measures' => 'nullable|string',
        ]);

        // Crear el plan de acción
        $actionPlan = ActionPlan::create([
            'entity_assignment_id' => $assignment->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'approval_date' => $validated['approval_date'],
            'status' => 'active',
            'notes' => $validated['notes'],
        ]);

        // Crear los items del plan
        foreach ($validated['items'] as $index => $item) {
            // Manejar archivos adjuntos
            $attachments = [];
            $fileKey = "items_files_{$index}";
            
            if ($request->hasFile($fileKey)) {
                foreach ($request->file($fileKey) as $file) {
                    $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('action_plans/attachments', $filename, 'public');
                    $attachments[] = [
                        'filename' => $file->getClientOriginalName(),
                        'path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                    ];
                }
            }

            // Crear el item
            $actionPlanItem = ActionPlanItem::create([
                'action_plan_id' => $actionPlan->id,
                'action_name' => $item['action_name'],
                'description' => $item['description'],
                'responsible' => $item['responsible'],
                'predecessor_action' => $item['predecessor_action'] ?? null,
                'start_date' => $item['start_date'],
                'end_date' => $item['end_date'],
                'business_days' => $item['business_days'] ?? null,
                'status' => $item['status'],
                'comments' => $item['comments'] ?? null,
                'problems' => $item['problems'] ?? null,
                'corrective_measures' => $item['corrective_measures'] ?? null,
                'attachments' => !empty($attachments) ? $attachments : null,
                'order' => $index + 1,
            ]);

            // Calcular días hábiles si no se proporcionaron
            if (!$item['business_days'] && $actionPlanItem->start_date && $actionPlanItem->end_date) {
                $actionPlanItem->calculateBusinessDays();
                $actionPlanItem->save();
            }
        }

        return redirect()
            ->route('execution.action-plans.show', $actionPlan->id)
            ->with('success', 'Plan de acción registrado exitosamente.');
    }

    /**
     * Mostrar detalle del plan de acción
     */
    public function show($id)
    {
        $actionPlan = ActionPlan::with([
            'entityAssignment.entity',
            'entityAssignment.sectorista',
            'items' => function ($query) {
                $query->orderBy('deadline', 'asc');
            }
        ])->findOrFail($id);

        return view('dashboard.execution.action-plans.show', compact('actionPlan'));
    }

    /**
     * Mostrar formulario para editar item del plan
     */
    public function editItem($itemId)
    {
        $item = ActionPlanItem::with('actionPlan.entityAssignment')->findOrFail($itemId);

        return view('dashboard.execution.action-plans.edit-item', compact('item'));
    }

    /**
     * Actualizar item del plan de acción
     */
    public function updateItem(Request $request, $itemId)
    {
        $item = ActionPlanItem::findOrFail($itemId);

        $validated = $request->validate([
            'status' => 'required|in:pendiente,proceso,en_proceso,finalizado',
            'predecessor_action' => 'nullable|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'business_days' => 'nullable|integer|min:0',
            'problems' => 'nullable|string',
            'corrective_measures' => 'nullable|string',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,xls,xlsx|max:10240',
        ]);

        // Normalizar status (convertir en_proceso a proceso)
        if (isset($validated['status']) && $validated['status'] === 'en_proceso') {
            $validated['status'] = 'proceso';
        }

        // Subir archivo si existe
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('action_plans/attachments', $filename, 'public');
            
            // Obtener attachments existentes o crear un array vacío
            $attachments = $item->attachments ?? [];
            
            // Agregar el nuevo archivo al array de attachments
            $attachments[] = [
                'filename' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'uploaded_at' => now()->toDateTimeString(),
            ];
            
            $validated['attachments'] = $attachments;
        }

        // Actualizar el item
        $item->update($validated);

        // Recalcular días hábiles si se actualizaron las fechas
        if (($request->has('start_date') || $request->has('end_date')) && $item->start_date && $item->end_date) {
            $item->calculateBusinessDays();
            $item->save();
        }

        return redirect()
            ->route('execution.action-plans.show', $item->action_plan_id)
            ->with('success', 'Acción actualizada exitosamente.');
    }

    /**
     * Eliminar archivo de un item
     */
    public function deleteFile($itemId, Request $request)
    {
        $item = ActionPlanItem::findOrFail($itemId);
        $attachmentIndex = $request->query('index', 0);

        $attachments = $item->attachments ?? [];

        if (isset($attachments[$attachmentIndex])) {
            $attachment = $attachments[$attachmentIndex];
            
            // Eliminar el archivo del storage
            if (isset($attachment['path']) && Storage::disk('public')->exists($attachment['path'])) {
                Storage::disk('public')->delete($attachment['path']);
            }

            // Remover el archivo del array
            array_splice($attachments, $attachmentIndex, 1);
            
            // Actualizar el item
            $item->update(['attachments' => empty($attachments) ? null : $attachments]);

            return redirect()
                ->route('execution.action-plans.show', $item->action_plan_id)
                ->with('success', 'Archivo eliminado exitosamente.');
        }

        return redirect()
            ->route('execution.action-plans.show', $item->action_plan_id)
            ->with('error', 'El archivo no existe.');
    }

    /**
     * Descargar archivo de un item
     */
    public function downloadFile($itemId, Request $request)
    {
        $item = ActionPlanItem::findOrFail($itemId);
        $attachmentIndex = $request->query('index', 0);

        $attachments = $item->attachments ?? [];

        if (isset($attachments[$attachmentIndex])) {
            $attachment = $attachments[$attachmentIndex];
            
            if (isset($attachment['path']) && Storage::disk('public')->exists($attachment['path'])) {
                return Storage::disk('public')->download($attachment['path'], $attachment['filename'] ?? null);
            }
        }

        return redirect()
            ->back()
            ->with('error', 'El archivo no existe.');
    }

    /**
     * Obtener plantilla de acciones predefinidas
     */
    public function getTemplate()
    {
        $templates = ActionPlanTemplate::getAllOrdered();
        
        return response()->json([
            'success' => true,
            'data' => $templates
        ]);
    }

    /**
     * Eliminar un plan de acción y sus items asociados
     */
    public function destroy($id)
    {
        $actionPlan = ActionPlan::with(['items', 'entityAssignment'])
            ->findOrFail($id);

        // Guardar el ID de la asignación para redirigir después
        $assignmentId = $actionPlan->entity_assignment_id;

        // Eliminar archivos asociados a los items
        foreach ($actionPlan->items as $item) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
        }

        // Eliminar el plan (los items se eliminan en cascada si está configurado)
        $actionPlan->delete();

        return redirect()
            ->route('execution.entity', $assignmentId)
            ->with('success', 'Plan de acción eliminado correctamente.');
    }
}

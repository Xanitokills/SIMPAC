<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\ActionPlanItem;
use App\Models\ActionPlanTemplate;
use App\Models\EntityAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

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
     * Retornar plantilla estándar de acciones en formato JSON
     */
    public function getTemplate(Request $request)
    {
        try {
            // Obtener plantillas ordenadas como array plano
            // El frontend se encargará de agruparlas por sección
            $templates = ActionPlanTemplate::orderBy('order')->get();

            return response()->json([
                'success' => true,
                'data' => $templates,
            ]);
        } catch (\Exception $e) {
            // Registrar el error y retornar respuesta JSON para evitar error 500 al cliente
            \Log::error('Error fetching action plan templates: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la plantilla estándar.'
            ], 500);
        }
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
            // Accept both legacy and normalized status values
            'items.*.status' => 'required|in:pendiente,proceso,finalizado,en_proceso,completado',
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
            // Normalizar estado para la DB (SQLite espera valores antiguos)
            if (isset($item['status'])) {
                if ($item['status'] === 'proceso') {
                    $item['status'] = 'en_proceso';
                } elseif ($item['status'] === 'finalizado') {
                    $item['status'] = 'completado';
                }
            }

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
            $itemData = [
                'action_plan_id' => $actionPlan->id,
                'action_name' => $item['action_name'],
                'description' => $item['description'],
                'responsible' => $item['responsible'],
                'predecessor_action' => $item['predecessor_action'] ?? null,
                'start_date' => $item['start_date'] ?? null,
                'end_date' => $item['end_date'],
                'business_days' => $item['business_days'] ?? null,
                'status' => $item['status'] ?? 'pendiente',
                'comments' => $item['comments'] ?? null,
                'problems' => $item['problems'] ?? null,
                'corrective_measures' => $item['corrective_measures'] ?? null,
                'attachments' => !empty($attachments) ? $attachments : null,
                'order' => $index + 1,
            ];

            // Añadir sección solo si la columna existe (migraación puede no haberse ejecutado)
            if (Schema::hasColumn('action_plan_items', 'section_name')) {
                if (!empty($item['section'])) {
                    $itemData['section_name'] = $item['section'];
                } else {
                    // Intentar obtener el título completo de la sección desde las plantillas por prefijo de código
                    $sectionName = null;
                    $code = $item['action_name'] ?? '';
                    $parts = explode('.', $code);
                    if (count($parts) >= 2) {
                        $prefix = $parts[0] . '.' . $parts[1];
                        // Buscar en ActionPlanTemplate un registro con código que empiece por el prefijo
                        $templateSection = ActionPlanTemplate::where('code', 'like', $prefix . '.%')->value('section');
                        $sectionName = $templateSection ?: $prefix;
                    }

                    $itemData['section_name'] = $sectionName;
                }
            }

            // Crear el item
            $actionPlanItem = ActionPlanItem::create($itemData);

            // Calcular días hábiles si no se proporcionaron
            if ((!isset($item['business_days']) || !$item['business_days']) && $actionPlanItem->start_date && $actionPlanItem->end_date) {
                $actionPlanItem->calculateBusinessDays();
                $actionPlanItem->save();
            }

        }

        return redirect()
            ->route('execution.action-plans.show', $actionPlan->id)
            ->with('success', 'Plan de acción registrado exitosamente.');
    }

    /**
     * Mostrar plan de acción
     */
    public function show($id)
    {
        $actionPlan = ActionPlan::with(['entityAssignment.entity', 'entityAssignment.sectorista', 'items'])
            ->findOrFail($id);

        // Agrupar items por sección para la vista
        $groupedItems = $actionPlan->items->groupBy(function($item) {
            // Usar section_name si existe, sino derivar del código
            if (!empty($item->section_name)) {
                return $item->section_name;
            }
            
            // Derivar sección del código (ej: "1.1.1" -> "1.1")
            $code = $item->action_name;
            $parts = explode('.', $code);
            if (count($parts) >= 2) {
                return $parts[0] . '.' . $parts[1];
            }
            
            return 'Sin sección';
        });

        return view('dashboard.execution.action-plans.show', compact('actionPlan', 'groupedItems'));
    }

    /**
     * Mostrar formulario para editar plan de acción
     */
    public function edit($id)
    {
        $actionPlan = ActionPlan::with(['entityAssignment.entity', 'entityAssignment.sectorista', 'items'])->findOrFail($id);

        return view('dashboard.execution.action-plans.edit', compact('actionPlan'));
    }

    /**
     * Actualizar plan de acción
     */
    public function update(Request $request, $id)
    {
        $actionPlan = ActionPlan::findOrFail($id);

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
            // Accept both legacy and normalized status values
            'items.*.status' => 'required|in:pendiente,proceso,finalizado,en_proceso,completado',
            'items.*.comments' => 'nullable|string',
            'items.*.problems' => 'nullable|string',
            'items.*.corrective_measures' => 'nullable|string',
        ]);

        // Actualizar el plan de acción
        $actionPlan->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'approval_date' => $validated['approval_date'],
            'notes' => $validated['notes'],
        ]);

        // Actualizar los items del plan
        foreach ($validated['items'] as $index => $item) {
            // Normalizar estado para la DB (SQLite espera valores antiguos)
            if (isset($item['status'])) {
                if ($item['status'] === 'proceso') {
                    $item['status'] = 'en_proceso';
                } elseif ($item['status'] === 'finalizado') {
                    $item['status'] = 'completado';
                }
            }

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

            // Datos para actualizar o crear el item
            $itemData = [
                'action_name' => $item['action_name'],
                'description' => $item['description'],
                'responsible' => $item['responsible'],
                'predecessor_action' => $item['predecessor_action'] ?? null,
                'start_date' => $item['start_date'] ?? null,
                'end_date' => $item['end_date'],
                'business_days' => $item['business_days'] ?? null,
                'status' => $item['status'] ?? 'pendiente',
                'comments' => $item['comments'] ?? null,
                'problems' => $item['problems'] ?? null,
                'corrective_measures' => $item['corrective_measures'] ?? null,
                'attachments' => !empty($attachments) ? $attachments : null,
                'order' => $index + 1,
            ];

            // Añadir sección solo si la columna existe (migraación puede no haberse ejecutado)
            if (Schema::hasColumn('action_plan_items', 'section_name')) {
                if (!empty($item['section'])) {
                    $itemData['section_name'] = $item['section'];
                } else {
                    // Intentar obtener el título completo de la sección desde las plantillas por prefijo de código
                    $sectionName = null;
                    $code = $item['action_name'] ?? '';
                    $parts = explode('.', $code);
                    if (count($parts) >= 2) {
                        $prefix = $parts[0] . '.' . $parts[1];
                        // Buscar en ActionPlanTemplate un registro con código que empiece por el prefijo
                        $templateSection = ActionPlanTemplate::where('code', 'like', $prefix . '.%')->value('section');
                        $sectionName = $templateSection ?: $prefix;
                    }

                    $itemData['section_name'] = $sectionName;
                }
            }

            // Buscar el item existente o crear uno nuevo
            $actionPlanItem = ActionPlanItem::find($item['id']);

            if ($actionPlanItem) {
                // Actualizar el item existente
                $actionPlanItem->update($itemData);
            } else {
                // Crear el nuevo item
                $actionPlanItem = ActionPlanItem::create($itemData);
            }

            // Calcular días hábiles si no se proporcionaron
            if ((!isset($item['business_days']) || !$item['business_days']) && $actionPlanItem->start_date && $actionPlanItem->end_date) {
                $actionPlanItem->calculateBusinessDays();
                $actionPlanItem->save();
            }
        }

        return redirect()
            ->route('execution.action-plans.show', $actionPlan->id)
            ->with('success', 'Plan de acción actualizado exitosamente.');
    }

    /**
     * Eliminar plan de acción
     */
    public function destroy($id)
    {
        $actionPlan = ActionPlan::with('items', 'entityAssignment')->findOrFail($id);
        $assignmentId = $actionPlan->entity_assignment_id;

        // Eliminar archivos adjuntos de los items
        foreach ($actionPlan->items as $item) {
            if (!empty($item->attachments)) {
                foreach ($item->attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }
        }

        // Eliminar el plan de acción y sus items
        $actionPlan->delete();

        return redirect()
            ->route('execution.action-plans.create', $assignmentId)
            ->with('success', 'Plan de acción eliminado exitosamente. Puede crear uno nuevo.');
    }
}

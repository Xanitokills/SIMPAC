<?php

namespace App\Http\Controllers;

use App\Models\ActionPlan;
use App\Models\ActionPlanItem;
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
            'items.*.action_description' => 'required|string',
            'items.*.responsible' => 'required|string|max:255',
            'items.*.deadline' => 'required|date',
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
        foreach ($validated['items'] as $item) {
            ActionPlanItem::create([
                'action_plan_id' => $actionPlan->id,
                'action_description' => $item['action_description'],
                'responsible' => $item['responsible'],
                'deadline' => $item['deadline'],
                'status' => 'pendiente',
                'comments' => null,
                'file_path' => null,
            ]);
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
            'status' => 'required|in:pendiente,en_proceso,finalizado',
            'predecessor_action' => 'nullable|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'business_days' => 'nullable|integer|min:0',
            'problems' => 'nullable|string',
            'corrective_measures' => 'nullable|string',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,xls,xlsx|max:10240',
        ]);

        // Subir archivo si existe
        if ($request->hasFile('file')) {
            // Eliminar archivo anterior si existe
            if ($item->file_path) {
                Storage::disk('public')->delete($item->file_path);
            }

            $path = $request->file('file')->store('action-plans', 'public');
            $validated['file_path'] = $path;
        }

        $item->update($validated);

        return redirect()
            ->route('action-plans.show', $item->action_plan_id)
            ->with('success', 'Acción actualizada exitosamente.');
    }

    /**
     * Eliminar archivo de un item
     */
    public function deleteFile($itemId)
    {
        $item = ActionPlanItem::findOrFail($itemId);

        if ($item->file_path) {
            Storage::disk('public')->delete($item->file_path);
            $item->update(['file_path' => null]);
        }

        return redirect()
            ->route('action-plans.show', $item->action_plan_id)
            ->with('success', 'Archivo eliminado exitosamente.');
    }

    /**
     * Descargar archivo de un item
     */
    public function downloadFile($itemId)
    {
        $item = ActionPlanItem::findOrFail($itemId);

        if (!$item->file_path || !Storage::disk('public')->exists($item->file_path)) {
            return redirect()
                ->back()
                ->with('error', 'El archivo no existe.');
        }

        return Storage::disk('public')->download($item->file_path);
    }
}

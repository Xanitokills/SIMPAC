<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Sectorista;
use App\Models\EntityAssignment;
use App\Models\ImplementationPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Requiere plan en la URL
        if (!$request->has('plan')) {
            return redirect()
                ->route('implementation-plans.index')
                ->with('error', 'Debe acceder a las asignaciones desde un plan específico.');
        }
        
        $plan = ImplementationPlan::findOrFail($request->plan);
        
        if ($plan->status !== 'active') {
            return redirect()
                ->route('implementation-plans.show', $plan)
                ->with('error', 'Solo puede gestionar asignaciones de planes activos.');
        }
        
        // Query base
        $query = EntityAssignment::with(['entity', 'sectorista', 'implementationPlan', 'assignedBy'])
            ->where('implementation_plan_id', $plan->id);
        
        // Filtros
        if ($request->filled('sectorista')) {
            $query->where('sectorista_id', $request->sectorista);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $assignments = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Estadísticas
        $stats = [
            'pending' => EntityAssignment::where('implementation_plan_id', $plan->id)->where('status', 'pending')->count(),
            'in_progress' => EntityAssignment::where('implementation_plan_id', $plan->id)->where('status', 'in_progress')->count(),
            'completed' => EntityAssignment::where('implementation_plan_id', $plan->id)->where('status', 'completed')->count(),
        ];
        
        // Sectoristas para el filtro
        $sectoristas = Sectorista::where('status', 'active')->orderBy('name')->get();
        
        return view('dashboard.entity-assignments.index', compact('assignments', 'plan', 'stats', 'sectoristas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!$request->has('plan')) {
            return redirect()
                ->route('implementation-plans.index')
                ->with('error', 'Debe acceder a las asignaciones desde un plan específico.');
        }
        
        $plan = ImplementationPlan::findOrFail($request->plan);
        
        if ($plan->status !== 'active') {
            return redirect()
                ->route('implementation-plans.show', $plan)
                ->with('error', 'Solo puede crear asignaciones en planes activos.');
        }
        
        // Obtener entidades que NO tienen asignación activa en este plan
        $entities = Entity::where('status', 'active')
            ->whereDoesntHave('assignments', function($query) use ($plan) {
                $query->where('implementation_plan_id', $plan->id)
                      ->whereIn('status', ['pending', 'in_progress']);
            })
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        
        // Obtener sectoristas activos
        $sectoristas = Sectorista::where('status', 'active')
            ->orderBy('name')
            ->get();
        
        return view('dashboard.entity-assignments.create', compact('entities', 'sectoristas', 'plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->has('plan')) {
            return back()->with('error', 'Debe acceder desde un plan específico.');
        }
        
        $plan = ImplementationPlan::findOrFail($request->plan);
        
        if ($plan->status !== 'active') {
            return back()->with('error', 'Solo puede crear asignaciones en planes activos.');
        }
        
        $validated = $request->validate([
            'entity_ids' => 'required|array|min:1',
            'entity_ids.*' => 'exists:entities,id',
            'sectorista_id' => 'required|exists:sectoristas,id',
            'notes' => 'nullable|string',
        ]);
        
        $created = 0;
        $skipped = 0;
        
        // Crear asignaciones para cada entidad seleccionada
        foreach ($validated['entity_ids'] as $entityId) {
            // Verificar que la entidad no tenga asignación activa en este plan
            $hasActiveAssignment = EntityAssignment::where('entity_id', $entityId)
                ->where('implementation_plan_id', $plan->id)
                ->whereIn('status', ['pending', 'in_progress'])
                ->exists();
            
            if ($hasActiveAssignment) {
                $skipped++;
                continue;
            }
            
            // Crear la asignación
            EntityAssignment::create([
                'entity_id' => $entityId,
                'sectorista_id' => $validated['sectorista_id'],
                'implementation_plan_id' => $plan->id,
                'assigned_at' => now(),
                'status' => 'pending',
                'assigned_by' => Auth::id(),
                'notes' => $validated['notes'],
            ]);
            
            $created++;
        }
        
        $message = "Se asignaron {$created} entidad(es) exitosamente.";
        if ($skipped > 0) {
            $message .= " {$skipped} entidad(es) ya tenían asignación activa.";
        }
        
        return redirect()
            ->route('entity-assignments.index', ['plan' => $plan->id])
            ->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(EntityAssignment $entityAssignment)
    {
        $entityAssignment->load(['entity', 'sectorista', 'implementationPlan', 'assignedBy']);
        
        return view('dashboard.entity-assignments.show', compact('entityAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntityAssignment $entityAssignment)
    {
        if ($entityAssignment->status !== 'active') {
            return redirect()
                ->route('entity-assignments.show', $entityAssignment)
                ->with('error', 'Solo se pueden editar asignaciones activas.');
        }
        
        $sectoristas = Sectorista::where('status', 'active')->get();
        
        return view('dashboard.entity-assignments.edit', compact('entityAssignment', 'sectoristas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntityAssignment $entityAssignment)
    {
        $validated = $request->validate([
            'sectorista_id' => 'required|exists:sectoristas,id',
            'notes' => 'nullable|string',
        ]);
        
        $entityAssignment->update($validated);
        
        return redirect()
            ->route('entity-assignments.show', $entityAssignment)
            ->with('success', 'Asignación actualizada exitosamente.');
    }

    /**
     * Finalizar una asignación
     */
    public function complete(Request $request)
    {
        $plan = ImplementationPlan::findOrFail($request->plan);
        $assignment = EntityAssignment::findOrFail($request->assignment);
        
        if (!in_array($assignment->status, ['pending', 'in_progress'])) {
            return back()->with('error', 'Solo se pueden completar asignaciones pendientes o en progreso.');
        }
        
        $assignment->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
        
        return redirect()
            ->route('entity-assignments.index', ['plan' => $plan->id])
            ->with('success', 'Asignación finalizada exitosamente.');
    }

    /**
     * Cancelar una asignación
     */
    public function cancel(Request $request)
    {
        $plan = ImplementationPlan::findOrFail($request->plan);
        $assignment = EntityAssignment::findOrFail($request->assignment);
        
        if (!in_array($assignment->status, ['pending', 'in_progress'])) {
            return back()->with('error', 'Solo se pueden cancelar asignaciones pendientes o en progreso.');
        }
        
        $assignment->update([
            'status' => 'cancelled',
            'completed_at' => now(),
        ]);
        
        return redirect()
            ->route('entity-assignments.index', ['plan' => $plan->id])
            ->with('success', 'Asignación cancelada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntityAssignment $entityAssignment)
    {
        if ($entityAssignment->status === 'active') {
            return back()->with('error', 'No se puede eliminar una asignación activa.');
        }
        
        $entityAssignment->delete();
        
        return redirect()
            ->route('entity-assignments.index')
            ->with('success', 'Asignación eliminada exitosamente.');
    }
}

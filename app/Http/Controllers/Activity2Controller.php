<?php

namespace App\Http\Controllers;

use App\Models\EntityAssignment;
use App\Models\Sectorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Activity2Controller extends Controller
{
    /**
     * Mostrar panel principal de Actividad 2
     * Lista todas las entidades asignadas al sectorista o todas si es Secretario CTPPGE
     */
    public function index($sectoristaId = null)
    {
        $user = Auth::user();

        // Verificar que el usuario esté autenticado
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        // Si es Secretario CTPPGE, redirigir con mensaje de restricción
        // El Secretario debe ver la gestión desde el Panel Principal, no desde el Seguimiento de Entidades
        if ($user->isSecretarioCTPPGE()) {
            return redirect()->route('dashboard.planning')
                ->with('warning', 'El Seguimiento de Entidades es una funcionalidad exclusiva para Sectoristas. Como Secretario CTPPGE, puedes supervisar el avance general desde el Panel Principal.');
        }

        // Para sectoristas
        if (!$sectoristaId && $user->isSectorista()) {
            $sectoristaId = $user->sectorista_id;
        }

        if (!$sectoristaId) {
            return redirect()->route('dashboard')
                ->with('error', 'No se encontró sectorista asociado o no tiene permisos para acceder.');
        }

        // Verificar que el sectorista solo vea sus asignaciones
        if ($user->isSectorista() && $user->sectorista_id != $sectoristaId) {
            return redirect()->route('activity2.index')
                ->with('error', 'No tiene permisos para ver las asignaciones de otro sectorista.');
        }

        $sectorista = Sectorista::with(['assignments.entity'])->findOrFail($sectoristaId);
        
        $assignments = EntityAssignment::where('sectorista_id', $sectoristaId)
            ->with([
                'entity',
                'meetings' => function($query) {
                    $query->latest()->limit(3);
                },
                'oficios' => function($query) {
                    $query->latest()->limit(3);
                },
                'inductionSessions' => function($query) {
                    $query->latest()->limit(3);
                }
            ])
            ->paginate(12);

        return view('activity2.index', compact('sectorista', 'assignments'));
    }

    /**
     * Ver detalle completo de una entidad asignada
     */
    public function show($assignmentId)
    {
        $assignment = EntityAssignment::with([
            'entity',
            'sectorista',
            'meetings.agreements',
            'oficios.actoResolutivo',
            'inductionSessions'
        ])->findOrFail($assignmentId);

        // Estadísticas rápidas
        $stats = [
            'meetings_total' => $assignment->meetings()->count(),
            'meetings_completed' => $assignment->meetings()->completed()->count(),
            'meetings_scheduled' => $assignment->meetings()->scheduled()->count(),
            'oficios_pending' => $assignment->oficios()->pendiente()->count(),
            'oficios_completed' => $assignment->oficios()->where('status', 'cumplido')->count(),
            'oficios_overdue' => $assignment->oficios()->vencido()->count(),
            'induction_sessions' => $assignment->inductionSessions()->count(),
        ];

        return view('activity2.show', compact('assignment', 'stats'));
    }

    /**
     * Mostrar formulario de edición de asignación
     */
    public function edit($assignmentId)
    {
        $user = Auth::user();
        
        $assignment = EntityAssignment::with([
            'entity',
            'sectorista'
        ])->findOrFail($assignmentId);

        // Verificar permisos
        if ($user->isSectorista() && $user->sectorista_id != $assignment->sectorista_id) {
            return redirect()->route('activity2.index')
                ->with('error', 'No tiene permisos para editar esta asignación.');
        }

        return view('activity2.edit', compact('assignment'));
    }

    /**
     * Actualizar asignación de entidad
     */
    public function update(Request $request, $assignmentId)
    {
        $user = Auth::user();
        
        $assignment = EntityAssignment::findOrFail($assignmentId);

        // Verificar permisos
        if ($user->isSectorista() && $user->sectorista_id != $assignment->sectorista_id) {
            return redirect()->route('activity2.index')
                ->with('error', 'No tiene permisos para editar esta asignación.');
        }

        $validated = $request->validate([
            'status' => 'required|in:active,pending,in_progress,completed,cancelled',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'notes' => 'nullable|string|max:1000',
        ]);

        $assignment->update($validated);

        return redirect()->route('activity2.show', $assignment->id)
            ->with('success', 'Asignación actualizada exitosamente.');
    }
}

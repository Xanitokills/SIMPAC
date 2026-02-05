<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('🏠 DashboardController@index called', [
            'user' => auth()->user() ? auth()->user()->email : 'guest',
            'role' => auth()->user() ? auth()->user()->role : 'none',
        ]);
        return view('dashboard.index');
    }

    public function planning()
    {
        Log::info('📋 DashboardController@planning called', [
            'user' => auth()->user() ? auth()->user()->email : 'guest',
            'role' => auth()->user() ? auth()->user()->role : 'none',
            'is_sectorista' => auth()->user() ? auth()->user()->isSectorista() : false,
            'view_file' => 'dashboard.planning',
        ]);
        return view('dashboard.planning');
    }

    public function execution()
    {
        // Obtener entidades asignadas según el rol del usuario
        $assignedEntities = collect();
        
        if (auth()->user()->role === 'sectorista') {
            // Si es sectorista, solo mostrar sus entidades asignadas
            // Primero buscar por sectorista_id vinculado al usuario, luego por email
            $sectorista = null;
            
            if (auth()->user()->sectorista_id) {
                $sectorista = \App\Models\Sectorista::find(auth()->user()->sectorista_id);
            }
            
            // Fallback: buscar por email
            if (!$sectorista) {
                $sectorista = \App\Models\Sectorista::where('email', auth()->user()->email)->first();
            }
            
            if ($sectorista) {
                $assignedEntities = \App\Models\EntityAssignment::where('sectorista_id', $sectorista->id)
                    ->with('entity')
                    ->get()
                    ->pluck('entity');
            }
        } else {
            // Si es admin o secretario, mostrar todas las entidades con asignación
            $assignedEntities = \App\Models\Entity::whereHas('assignments')->get();
        }
        
        return view('dashboard.execution', compact('assignedEntities'));
    }

    public function validation()
    {
        return view('dashboard.validation');
    }

    public function closure()
    {
        return view('dashboard.closure');
    }

    public function closureEntity($id)
    {
        // En producción, aquí se obtendrían los datos reales de la base de datos
        return view('dashboard.closure.entity');
    }

    public function components()
    {
        return view('dashboard.components');
    }

    public function documents()
    {
        return view('dashboard.documents');
    }

    public function timeline()
    {
        return view('dashboard.timeline');
    }

    /**
     * Redirigir a la página de seguimiento de ejecución para una entidad
     */
    public function selectEntity(Request $request)
    {
        $entityAssignmentId = $request->get('entity_assignment_id');
        
        if (!$entityAssignmentId) {
            return redirect()->route('dashboard.execution')
                ->with('error', 'Debe seleccionar una entidad.');
        }

        return redirect()->route('execution.entity', $entityAssignmentId);
    }

    /**
     * Mostrar panel de seguimiento de ejecución para una entidad específica
     */
    public function executionEntity($assignmentId)
    {
        $assignment = \App\Models\EntityAssignment::with(['entity', 'sectorista'])
            ->findOrFail($assignmentId);

        // Verificar permisos
        if (auth()->user()->role === 'sectorista') {
            // Buscar sectorista por sectorista_id del usuario o por email como fallback
            $sectorista = null;
            if (auth()->user()->sectorista_id) {
                $sectorista = \App\Models\Sectorista::find(auth()->user()->sectorista_id);
            }
            if (!$sectorista) {
                $sectorista = \App\Models\Sectorista::where('email', auth()->user()->email)->first();
            }
            
            if (!$sectorista || $assignment->sectorista_id !== $sectorista->id) {
                return redirect()->route('dashboard.execution')
                    ->with('error', 'No tiene permisos para acceder a esta entidad.');
            }
        }

        // Obtener reuniones de coordinación
        $meetings = \App\Models\Meeting::where('entity_assignment_id', $assignmentId)
            ->whereIn('meeting_type', ['coordination', 'general'])
            ->orderBy('scheduled_date', 'desc')
            ->get();

        // Obtener oficios con seguimiento de notificaciones
        $oficios = \App\Models\Oficio::where('entity_assignment_id', $assignmentId)
            ->orderBy('created_at', 'desc')
            ->get();

        // Estadísticas de notificaciones
        $notificationStats = [
            'overdue' => $oficios->where('notification_status', 'overdue')->count(),
            'pending' => $oficios->where('notification_status', 'pending')->count(),
            'notified' => $oficios->where('notification_status', 'notified')->count(),
            'completed' => $oficios->where('notification_status', 'completed')->count(),
        ];

        // Obtener plan de acción de la entidad
        $actionPlan = \App\Models\ActionPlan::where('entity_assignment_id', $assignmentId)
            ->with(['items' => function ($query) {
                $query->orderBy('deadline', 'asc');
            }])
            ->first();

        return view('dashboard.execution.entity', compact(
            'assignment',
            'meetings',
            'oficios',
            'notificationStats',
            'actionPlan'
        ));
    }
}

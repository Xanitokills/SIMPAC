@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('execution.entity', $meeting->entityAssignment->id) }}" 
               class="text-blue-600 hover:text-blue-800 mb-2 inline-block">
                ← Volver a {{ $meeting->entityAssignment->entity->name }}
            </a>
            <h1 class="text-3xl font-bold text-gray-800">
                Reunión de Coordinación
            </h1>
        </div>
        
        <div class="flex gap-3">
            @if($meeting->status === 'pending')
                <a href="{{ route('execution.meetings.edit', $meeting->id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold">
                    Editar
                </a>
                <form action="{{ route('execution.meetings.complete', $meeting->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold"
                            onclick="return confirm('¿Marcar esta reunión como completada?')">
                        Marcar Completada
                    </button>
                </form>
                <form action="{{ route('execution.meetings.cancel', $meeting->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-semibold"
                            onclick="return confirm('¿Cancelar esta reunión?')">
                        Cancelar
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Meeting Details Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Entidad</h3>
                    <p class="text-lg text-gray-900">{{ $meeting->entityAssignment->entity->name }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Sectorista Responsable</h3>
                    <p class="text-lg text-gray-900">{{ $meeting->entityAssignment->sectorista->name }}</p>
                    <p class="text-sm text-gray-600">{{ $meeting->entityAssignment->sectorista->email }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Asunto de la Reunión</h3>
                    <p class="text-lg text-gray-900">{{ $meeting->subject }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Tipo de Reunión</h3>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($meeting->meeting_type === 'coordination') bg-blue-100 text-blue-800
                        @elseif($meeting->meeting_type === 'presentation') bg-teal-100 text-teal-800
                        @elseif($meeting->meeting_type === 'follow_up') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        @if($meeting->meeting_type === 'coordination') Coordinación
                        @elseif($meeting->meeting_type === 'presentation') Presentación de Propuesta
                        @elseif($meeting->meeting_type === 'follow_up') Seguimiento
                        @else {{ $meeting->meeting_type }}
                        @endif
                    </span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Fecha y Hora</h3>
                    <p class="text-lg text-gray-900">
                        {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Ubicación</h3>
                    <p class="text-lg text-gray-900">{{ $meeting->location ?? 'No especificada' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Estado</h3>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        @if($meeting->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($meeting->status === 'completed') bg-green-100 text-green-800
                        @elseif($meeting->status === 'cancelled') bg-slate-100 text-slate-800
                        @endif">
                        @if($meeting->status === 'pending') Pendiente
                        @elseif($meeting->status === 'completed') Completada
                        @elseif($meeting->status === 'cancelled') Cancelada
                        @endif
                    </span>
                </div>

                @if($meeting->completed_at)
                <div>
                    <h3 class="text-sm font-semibold text-gray-600 mb-1">Completada el</h3>
                    <p class="text-lg text-gray-900">
                        {{ \Carbon\Carbon::parse($meeting->completed_at)->format('d/m/Y H:i') }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Description -->
        @if($meeting->description)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-600 mb-2">Descripción</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $meeting->description }}</p>
        </div>
        @endif

        <!-- Participants -->
        @if($meeting->participants)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-600 mb-2">Participantes</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $meeting->participants }}</p>
        </div>
        @endif

        <!-- Outcome -->
        @if($meeting->outcome)
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-sm font-semibold text-gray-600 mb-2">Resultado de la Reunión</h3>
            <p class="text-gray-900 whitespace-pre-wrap">{{ $meeting->outcome }}</p>
        </div>
        @endif
    </div>

    <!-- Action Plan Section -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Plan de Acción Aprobado</h2>
            
            @if($meeting->status === 'completed' && !$meeting->actionPlan)
                <a href="{{ route('execution.action-plans.create', $meeting->id) }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">
                    + Registrar Plan de Acción
                </a>
            @endif
        </div>

        @if($meeting->actionPlan)
            <!-- Action Plan Exists -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $meeting->actionPlan->title }}</h3>
                        <p class="text-gray-700 mb-3">{{ $meeting->actionPlan->description }}</p>
                        
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Fecha de Aprobación:</strong> {{ \Carbon\Carbon::parse($meeting->actionPlan->approval_date)->format('d/m/Y') }}</p>
                            <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($meeting->actionPlan->start_date)->format('d/m/Y') }}</p>
                            <p><strong>Fecha de Finalización:</strong> {{ \Carbon\Carbon::parse($meeting->actionPlan->end_date)->format('d/m/Y') }}</p>
                            <p>
                                <strong>Estado:</strong> 
                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                    @if($meeting->actionPlan->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($meeting->actionPlan->status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($meeting->actionPlan->status === 'completed') bg-green-100 text-green-800
                                    @elseif($meeting->actionPlan->status === 'cancelled') bg-slate-100 text-slate-800
                                    @endif">
                                    @if($meeting->actionPlan->status === 'pending') Pendiente
                                    @elseif($meeting->actionPlan->status === 'in_progress') En Progreso
                                    @elseif($meeting->actionPlan->status === 'completed') Completado
                                    @elseif($meeting->actionPlan->status === 'cancelled') Cancelado
                                    @endif
                                </span>
                            </p>
                            <p><strong>Total de Acciones:</strong> {{ $meeting->actionPlan->items->count() }}</p>
                            <p><strong>Acciones Completadas:</strong> {{ $meeting->actionPlan->items->where('status', 'completed')->count() }}</p>
                        </div>
                    </div>
                    
                    <a href="{{ route('execution.action-plans.show', $meeting->actionPlan->id) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold whitespace-nowrap ml-4">
                        Ver y Gestionar Plan
                    </a>
                </div>
            </div>

            <!-- Quick Summary of Actions -->
            @if($meeting->actionPlan->items->count() > 0)
            <div class="mt-4">
                <h4 class="font-semibold text-gray-700 mb-3">Resumen de Acciones:</h4>
                <div class="space-y-2">
                    @foreach($meeting->actionPlan->items->take(5) as $item)
                    <div class="flex items-center justify-between bg-gray-50 p-3 rounded">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $item->action_description }}</p>
                            <p class="text-sm text-gray-600">Responsable: {{ $item->responsible }}</p>
                        </div>
                        <span class="ml-3 px-2 py-1 rounded text-xs font-semibold
                            @if($item->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($item->status === 'in_progress') bg-blue-100 text-blue-800
                            @elseif($item->status === 'completed') bg-green-100 text-green-800
                            @endif">
                            @if($item->status === 'pending') Pendiente
                            @elseif($item->status === 'in_progress') En Progreso
                            @elseif($item->status === 'completed') Completada
                            @endif
                        </span>
                    </div>
                    @endforeach
                    
                    @if($meeting->actionPlan->items->count() > 5)
                    <p class="text-sm text-gray-600 text-center py-2">
                        Y {{ $meeting->actionPlan->items->count() - 5 }} acción(es) más...
                    </p>
                    @endif
                </div>
            </div>
            @endif

        @else
            <!-- No Action Plan Yet -->
            @if($meeting->status === 'completed')
            <div class="text-center py-8 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-lg font-medium mb-2">No hay plan de acción registrado</p>
                <p class="text-sm mb-4">Registre el plan de acción aprobado en esta reunión</p>
                <a href="{{ route('execution.action-plans.create', $meeting->id) }}" 
                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                    + Registrar Plan de Acción
                </a>
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg font-medium mb-2">Reunión Pendiente</p>
                <p class="text-sm">Complete la reunión antes de registrar un plan de acción</p>
            </div>
            @endif
        @endif
    </div>
</div>
@endsection

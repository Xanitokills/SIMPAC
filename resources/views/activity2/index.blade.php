@extends('layouts.dashboard')

@section('page-title', 'Actividad 2: Órgano Colegiado')
@section('page-description', 'Gestión de entidades asignadas')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Actividad 2: Solicitar Conformación del Órgano Colegiado</h1>
                <p class="mt-2 text-gray-600">Sectorista: <span class="font-semibold">{{ $sectorista->name }}</span></p>
                <p class="text-sm text-gray-500 mt-1">Gestión de entidades asignadas y coordinaciones</p>
            </div>
            <div class="text-right">
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $assignments->total() }} Entidades Asignadas
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Entidades Asignadas -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Entidades Asignadas</h2>
        
        @if($assignments->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($assignments as $assignment)
                    <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition-shadow">
                        <!-- Nombre de la Entidad -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $assignment->entity->name }}</h3>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $assignment->entity->type }}
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $assignment->entity->sector }}
                                </span>
                            </div>
                        </div>

                        <!-- Estadísticas Rápidas -->
                        <div class="space-y-2 mb-4 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Reuniones:</span>
                                <span class="font-semibold">{{ $assignment->meetings->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Oficios:</span>
                                <span class="font-semibold">{{ $assignment->oficios->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Sesiones Inducción:</span>
                                <span class="font-semibold">{{ $assignment->inductionSessions->count() }}</span>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            @php
                                $statusLabels = [
                                    'active' => 'Activo',
                                    'pending' => 'Pendiente',
                                    'in_progress' => 'En Progreso',
                                    'completed' => 'Completado',
                                    'cancelled' => 'Cancelado',
                                ];
                                $statusColors = [
                                    'active' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'in_progress' => 'bg-blue-100 text-blue-800',
                                    'completed' => 'bg-purple-100 text-purple-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $currentStatus = strtolower($assignment->status);
                                $statusLabel = $statusLabels[$currentStatus] ?? ucfirst($assignment->status);
                                $statusColor = $statusColors[$currentStatus] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        <!-- Acciones -->
                        <div class="space-y-2">
                            <a href="{{ route('activity2.show', $assignment->id) }}" 
                               class="block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Ver Detalles
                            </a>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('meetings.index', $assignment->id) }}" 
                                   class="text-center px-3 py-2 border border-gray-300 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-50 transition-colors">
                                    Reuniones
                                </a>
                                <a href="{{ route('oficios.index', $assignment->id) }}" 
                                   class="text-center px-3 py-2 border border-gray-300 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-50 transition-colors">
                                    Oficios
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $assignments->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay entidades asignadas</h3>
                <p class="mt-1 text-sm text-gray-500">No se han asignado entidades a este sectorista.</p>
            </div>
        @endif
    </div>
</div>
@endsection

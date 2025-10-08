@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Actividad 2: Solicitar Conformación del Órgano Colegiado</h1>
                <p class="mt-2 text-gray-600">Vista General - <span class="font-semibold">Secretario CTPPGE</span></p>
                <p class="text-sm text-gray-500 mt-1">Coordinación general del proceso de transferencia</p>
            </div>
            <div class="text-right">
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $assignments->total() }} Asignaciones Totales
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de Sectoristas -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Sectoristas Activos</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($sectoristas as $sectorista)
                <a href="{{ route('activity2.index', $sectorista->id) }}" 
                   class="block p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-blue-500 transition-all">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-gray-900 text-sm">{{ $sectorista->name }}</h3>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 text-xs font-bold">
                            {{ $sectorista->assignments_count }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-600">{{ $sectorista->email }}</p>
                    <div class="mt-2 text-xs text-blue-600 font-medium">
                        Ver asignaciones →
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Estadísticas Globales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
        <!-- Total Asignaciones -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600">Total Asignaciones</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_assignments'] }}</p>
                </div>
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Reuniones -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600">Reuniones</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_meetings'] }}</p>
                </div>
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Oficios -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600">Oficios</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_oficios'] }}</p>
                </div>
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pendientes -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600">Pendientes</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $stats['oficios_pending'] }}</p>
                </div>
                <div class="p-2 bg-orange-100 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Vencidos -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600">Vencidos</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['oficios_overdue'] }}</p>
                </div>
                <div class="p-2 bg-red-100 rounded-lg">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Listado de Todas las Asignaciones -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Todas las Asignaciones de Entidades</h2>
        
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

                        <!-- Sectorista Asignado -->
                        <div class="mb-3 p-2 bg-blue-50 rounded">
                            <p class="text-xs text-gray-600">Sectorista:</p>
                            <p class="text-sm font-semibold text-blue-900">{{ $assignment->sectorista->name }}</p>
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
                                <span class="text-gray-600">Sesiones:</span>
                                <span class="font-semibold">{{ $assignment->inductionSessions->count() }}</span>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            @php
                                $statusColors = [
                                    'in_progress' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$assignment->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                            </span>
                        </div>

                        <!-- Acciones -->
                        <div class="space-y-2">
                            <a href="{{ route('activity2.show', $assignment->id) }}" 
                               class="block w-full text-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Ver Detalles
                            </a>
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
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay asignaciones</h3>
                <p class="mt-1 text-sm text-gray-500">No se han creado asignaciones de entidades aún.</p>
            </div>
        @endif
    </div>
</div>
@endsection

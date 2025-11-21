@extends('layouts.dashboard')

@section('page-title', 'Detalles de Entidad')
@section('page-description', $assignment->entity->name)

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="mb-4 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('activity2.index') }}" class="hover:text-blue-600">Actividad 2</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">{{ $assignment->entity->name }}</li>
        </ol>
    </nav>

    <!-- Header con Información de la Entidad -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-900">{{ $assignment->entity->name }}</h1>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-800">
                        {{ $assignment->entity->type }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        {{ $assignment->entity->sector }}
                    </span>
                </div>
                <p class="mt-2 text-gray-600">Sectorista: <span class="font-semibold">{{ $assignment->sectorista->name }}</span></p>
            </div>
            <div class="text-right flex flex-col items-end space-y-2">
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
                        'completed' => 'bg-emerald-100 text-emerald-800',
                        'cancelled' => 'bg-slate-100 text-slate-800',
                    ];
                    $currentStatus = strtolower($assignment->status);
                    $statusLabel = $statusLabels[$currentStatus] ?? ucfirst($assignment->status);
                    $statusColor = $statusColors[$currentStatus] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                    {{ $statusLabel }}
                </span>
                <a href="{{ route('activity2.edit', $assignment->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Reuniones -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Reuniones</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['meetings_total'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $stats['meetings_completed'] }} completadas
                    </p>
                </div>
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Oficios -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Oficios</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['oficios_pending'] + $stats['oficios_completed'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $stats['oficios_pending'] }} pendientes
                    </p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Oficios Vencidos -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Vencidos</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $stats['oficios_overdue'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Requieren acción</p>
                </div>
                <div class="p-3 bg-amber-100 rounded-lg">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sesiones de Inducción -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Sesiones Inducción</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['induction_sessions'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">Programadas</p>
                </div>
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <a href="{{ route('meetings.create', $assignment->id) }}" 
           class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow border-2 border-transparent hover:border-blue-500">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Programar Reunión</h3>
                    <p class="text-sm text-gray-600">Coordinar con la entidad</p>
                </div>
            </div>
        </a>

        <a href="{{ route('oficios.create', $assignment->id) }}" 
           class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow border-2 border-transparent hover:border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Generar Oficio</h3>
                    <p class="text-sm text-gray-600">Cargar documento enviado</p>
                </div>
            </div>
        </a>

        <a href="{{ route('agreements.tracking', $assignment->id) }}" 
           class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow border-2 border-transparent hover:border-green-500">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Ver Acuerdos</h3>
                    <p class="text-sm text-gray-600">Seguimiento visual</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Tabs de Navegación -->
    <div class="bg-white rounded-lg shadow-sm mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <a href="{{ route('meetings.index', $assignment->id) }}" 
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Reuniones ({{ $stats['meetings_total'] }})
                </a>
                <a href="{{ route('oficios.index', $assignment->id) }}" 
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Oficios ({{ $stats['oficios_pending'] + $stats['oficios_completed'] }})
                </a>
                <a href="{{ route('induction-sessions.index', $assignment->id) }}" 
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Sesiones Inducción ({{ $stats['induction_sessions'] }})
                </a>
                <a href="{{ route('agreements.tracking', $assignment->id) }}" 
                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Seguimiento Acuerdos
                </a>
            </nav>
        </div>
    </div>

    <!-- Actividades Recientes -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Actividades Recientes</h2>
        
        <div class="space-y-4">
            @forelse($assignment->meetings->take(3) as $meeting)
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900">Reunión: {{ $meeting->subject }}</p>
                            <p class="text-sm text-gray-600">{{ $meeting->scheduled_date->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded {{ $meeting->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($meeting->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-sm">No hay reuniones registradas</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

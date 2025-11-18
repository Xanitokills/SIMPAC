@extends('layouts.dashboard')

@section('page-title', 'Seguimiento de Ejecución')
@section('page-description', 'Gestión de reuniones y notificaciones para ' . $assignment->entity->name)

@section('content')
<div class="space-y-6">
    <!-- Header con información de la entidad -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $assignment->entity->name }}</h1>
                        <p class="text-indigo-100 mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white mr-2">
                                {{ $assignment->entity->type }}
                            </span>
                            Sectorista: {{ $assignment->sectorista->name }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('dashboard.execution') }}" 
                   class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Cambiar Entidad</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Módulo 1: Reuniones de Coordinación -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Reuniones de Coordinación y Presentación de Propuesta</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestionar reuniones para la presentación de propuestas por componente</p>
                </div>
                <a href="{{ route('execution.meetings.create', ['assignment' => $assignment->id]) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Programar Reunión</span>
                </a>
            </div>

            @if($meetings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Programada</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asunto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Componentes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($meetings as $meeting)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="font-medium">{{ $meeting->scheduled_date->format('d M Y, H:i') }}</div>
                                    <div class="text-xs text-gray-500">{{ $meeting->scheduled_date->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $meeting->subject }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @php $components = json_decode($meeting->components, true) ?? []; @endphp
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($components as $component)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                @if($component === 'presupuesto') bg-blue-100 text-blue-800
                                                @elseif($component === 'bienes') bg-purple-100 text-purple-800
                                                @elseif($component === 'acervo') bg-green-100 text-green-800
                                                @elseif($component === 'tecnologia') bg-orange-100 text-orange-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($component) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($meeting->status === 'scheduled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Programada
                                        </span>
                                    @elseif($meeting->status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completada
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($meeting->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('execution.meetings.show', $meeting->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                    @if($meeting->status === 'scheduled')
                                        <a href="{{ route('execution.meetings.edit', $meeting->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 mb-4">No hay reuniones programadas para esta entidad</p>
                    <a href="{{ route('execution.meetings.create', ['assignment' => $assignment->id]) }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium">
                        Programar primera reunión →
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Módulo 2: Notificaciones y Seguimiento -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Notificaciones y Seguimiento de Respuestas</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestión de notificaciones y evidencias de seguimiento</p>
                </div>
                <a href="{{ route('execution.notifications.create', ['assignment' => $assignment->id]) }}" 
                   class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>Crear Notificación</span>
                </a>
            </div>

            <!-- Resumen de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-red-50 rounded-lg p-4 border border-red-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-red-900">Vencidos</p>
                            <p class="text-2xl font-bold text-red-700">{{ $notificationStats['overdue'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-yellow-900">Pendientes</p>
                            <p class="text-2xl font-bold text-yellow-700">{{ $notificationStats['pending'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-900">Notificados</p>
                            <p class="text-2xl font-bold text-blue-700">{{ $notificationStats['notified'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-900">Completados</p>
                            <p class="text-2xl font-bold text-green-700">{{ $notificationStats['completed'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            @if($oficios->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Oficio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notificaciones</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($oficios as $oficio)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="font-medium">{{ $oficio->numero_oficio }}</div>
                                    <div class="text-xs text-gray-500">{{ $oficio->asunto }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($oficio->deadline_date)
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($oficio->deadline_date)->format('d M Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($oficio->deadline_date)->diffForHumans() }}</div>
                                    @else
                                        <span class="text-gray-400">Sin fecha límite</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center space-x-1">
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-bold">
                                            {{ $oficio->notification_count ?? 0 }}
                                        </span>
                                        <span class="text-xs text-gray-500">enviadas</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($oficio->notification_status === 'overdue')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Vencido
                                        </span>
                                    @elseif($oficio->notification_status === 'completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completado
                                        </span>
                                    @elseif($oficio->notification_status === 'notified')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Notificado
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pendiente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('execution.notifications.show', $oficio->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                    <a href="{{ route('oficios.show', $oficio->id) }}" class="text-indigo-600 hover:text-indigo-900">Oficio</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-gray-500 mb-4">No hay oficios con seguimiento para esta entidad</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

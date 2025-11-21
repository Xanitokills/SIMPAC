@extends('layouts.dashboard')

@section('page-title', 'Seguimiento de Ejecución')
@section('page-description', 'Gestión de reuniones y notificaciones para ' . $assignment->entity->name)

@section('content')
<div class="space-y-6">
    <!-- Header con información de la entidad -->
    <div class="bg-gradient-to-r from-slate-700 to-slate-800 rounded-lg shadow-lg text-white">
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
                        <p class="text-slate-200 mt-1">
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
                                                @elseif($component === 'bienes') bg-slate-100 text-slate-800
                                                @elseif($component === 'acervo') bg-emerald-100 text-emerald-800
                                                @elseif($component === 'tecnologia') bg-cyan-100 text-cyan-800
                                                @else bg-teal-100 text-teal-800 @endif">
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
                                        <a href="{{ route('execution.meetings.edit', $meeting->id) }}" class="text-slate-600 hover:text-slate-900">Editar</a>
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
                    <h3 class="text-lg font-semibold text-gray-900">Seguimiento a Doc Enviados</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestión de notificaciones y evidencias de seguimiento</p>
                </div>
                <a href="{{ route('execution.notifications.create', ['assignment' => $assignment->id]) }}" 
                   class="bg-slate-600 hover:bg-slate-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>Crear Notificación</span>
                </a>
            </div>

            <!-- Resumen de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-900">Vencidos</p>
                            <p class="text-2xl font-bold text-slate-700">{{ $notificationStats['overdue'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-amber-50 rounded-lg p-4 border border-amber-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-amber-900">Pendientes</p>
                            <p class="text-2xl font-bold text-amber-700">{{ $notificationStats['pending'] }}</p>
                        </div>
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Emisión</th>
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
                                    <div class="font-medium">{{ $oficio->numero_oficio ?? 'Oficio N° ' . str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) . '-2025-PGE/CTPPGE' }}</div>
                                    <div class="text-xs text-gray-500">{{ $oficio->asunto ?? 'Solicitud de conformación del órgano colegiado' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($oficio->fecha_emision ?? $oficio->created_at)
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($oficio->fecha_emision ?? $oficio->created_at)->format('d M Y') }}</div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
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
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
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
                                    <a href="{{ route('oficios.show', $oficio->id) }}" class="text-slate-600 hover:text-slate-900">Oficio</a>
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

    <!-- Módulo 3: Plan de Acción Aprobado (HU5) -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Plan de Acción Aprobado</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestión del plan de acción aprobado para esta entidad</p>
                </div>
                @if(!$actionPlan)
                    <a href="{{ route('execution.action-plans.create', ['assignment' => $assignment->id]) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Registrar Plan de Acción</span>
                    </a>
                @endif
            </div>

            @if($actionPlan)
                <!-- Plan de acción existente -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border border-green-200 p-6 mb-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $actionPlan->title }}</h4>
                            @if($actionPlan->description)
                                <p class="text-sm text-gray-600 mb-3">{{ $actionPlan->description }}</p>
                            @endif
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Fecha de Aprobación:</span>
                                    <span class="font-semibold ml-2">{{ $actionPlan->approval_date->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Estado:</span>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $actionPlan->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $actionPlan->status === 'active' ? 'Activo' : 'Completado' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('execution.action-plans.show', $actionPlan->id) }}" 
                           class="ml-4 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>Ver Detalle</span>
                        </a>
                    </div>
                </div>

                <!-- Estadísticas del plan -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-900">Total Acciones</p>
                                <p class="text-2xl font-bold text-blue-700">{{ $actionPlan->items->count() }}</p>
                            </div>
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pendientes</p>
                                <p class="text-2xl font-bold text-gray-700">{{ $actionPlan->items->where('status', 'pendiente')->count() }}</p>
                            </div>
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-900">En Proceso</p>
                                <p class="text-2xl font-bold text-yellow-700">{{ $actionPlan->items->where('status', 'en_proceso')->count() }}</p>
                            </div>
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-900">Finalizadas</p>
                                <p class="text-2xl font-bold text-green-700">{{ $actionPlan->items->where('status', 'finalizado')->count() }}</p>
                            </div>
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Próximas acciones -->
                @if($actionPlan->items->where('status', '!=', 'finalizado')->count() > 0)
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Próximas Acciones</h4>
                        <div class="space-y-2">
                            @foreach($actionPlan->items->where('status', '!=', 'finalizado')->take(5) as $item)
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">{{ Str::limit($item->action_description, 60) }}</p>
                                        <p class="text-xs text-gray-500">Responsable: {{ $item->responsible }}</p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-xs text-gray-600">{{ \Carbon\Carbon::parse($item->deadline)->format('d/m/Y') }}</span>
                                        @if($item->status === 'pendiente')
                                            <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded">Pendiente</span>
                                        @elseif($item->status === 'en_proceso')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded">En Proceso</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <!-- Sin plan de acción -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-500 mb-4">No hay plan de acción registrado para esta entidad</p>
                    <a href="{{ route('execution.action-plans.create', ['assignment' => $assignment->id]) }}" 
                       class="text-green-600 hover:text-green-700 font-medium">
                        Registrar plan de acción →
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Módulo 4: Actas de Reunión (HU6) -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Actas de Reunión</h3>
                    <p class="text-sm text-gray-500 mt-1">Registrar y gestionar actas de reunión por componente</p>
                </div>
                <a href="{{ route('execution.minutes.create', ['assignment' => $assignment->id]) }}" 
                   class="bg-slate-600 hover:bg-slate-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Registrar Acta</span>
                </a>
            </div>

            @php
                $minutes = \App\Models\MeetingMinute::where('entity_assignment_id', $assignment->id)->orderBy('date', 'desc')->get();
            @endphp

            @if($minutes->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Acta</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asunto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Componente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($minutes as $m)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $m->minute_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($m->date)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $m->subject }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $m->component }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($m->status === 'firmado')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Firmado</span>
                                    @elseif($m->status === 'falta_de_firma')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Falta de firma</span>
                                    @elseif($m->status === 'proceso_de_firmas')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Proceso de firmas</span>
                                    @elseif($m->status === 'proceso_de_firmas_pge')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Proceso de firmas PGE</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium space-x-2">
                                    @if($m->pdf_path)
                                        <a href="{{ route('execution.minutes.download', $m->id) }}" class="text-blue-600 hover:text-blue-900">Descargar PDF</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>No hay actas registradas</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Módulo 5: Seguimiento por Componentes -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Seguimiento por Componentes</h3>
                    <p class="text-sm text-gray-500 mt-1">Seguimiento del avance por cada componente del proceso de transferencia</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {{-- 1. Recursos Presupuestarios --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            En Proceso
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">1. Recursos Presupuestarios</h4>
                    <p class="text-sm text-gray-500 mb-3">Seguimiento de recursos financieros y presupuesto asignado</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Avance:</span>
                        <span class="font-semibold text-gray-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                {{-- 2. Recursos Humanos --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                            Pendiente
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">2. Recursos Humanos</h4>
                    <p class="text-sm text-gray-500 mb-3">Gestión del personal y asignaciones de responsables</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Avance:</span>
                        <span class="font-semibold text-gray-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                {{-- 3. Bienes y Servicios --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                            Pendiente
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">3. Bienes y Servicios</h4>
                    <p class="text-sm text-gray-500 mb-3">Inventario y gestión de bienes patrimoniales</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Avance:</span>
                        <span class="font-semibold text-gray-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                {{-- 4. Acervo Documentario --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                            Pendiente
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">4. Acervo Documentario</h4>
                    <p class="text-sm text-gray-500 mb-3">Gestión documental y archivo institucional</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Avance:</span>
                        <span class="font-semibold text-gray-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                {{-- 5. Activos Informáticos --}}
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-gray-300 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                            Pendiente
                        </span>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">5. Activos Informáticos</h4>
                    <p class="text-sm text-gray-500 mb-3">Equipos de cómputo, software y sistemas de información</p>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Avance:</span>
                        <span class="font-semibold text-gray-700">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

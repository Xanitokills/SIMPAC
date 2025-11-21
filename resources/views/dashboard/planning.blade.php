@extends('layouts.dashboard')

@section('page-title', 'Actividades Previas')
@section('page-description', 'Fase 1: Conformación del Órgano Colegiado y aprobación del Plan de Trabajo')

@section('content')
<!-- 🔍 DEBUG: Este es el archivo dashboard/planning.blade.php -->
<div class="mb-4 p-4 bg-red-100 border-2 border-red-500 rounded-lg">
    <p class="text-red-900 font-bold text-lg">🔍 ARCHIVO: dashboard/planning.blade.php</p>
    <p class="text-red-700 text-sm">Si ves este mensaje, estás en el archivo CORRECTO</p>
    @if(auth()->check())
        <p class="text-red-700 text-xs mt-2">
            Usuario: {{ auth()->user()->email }} | 
            Rol: {{ auth()->user()->role }} | 
            Es Sectorista: {{ auth()->user()->isSectorista() ? 'SÍ' : 'NO' }}
        </p>
    @endif
</div>
<!-- FIN DEBUG -->

<div class="space-y-6">
    <!-- Phase Overview -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 1: Actividades Previas</h2>
                    <p class="text-blue-100 mt-1">Duración estimada: 7 días hábiles</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">28%</div>
                    <div class="text-sm text-blue-100">Completado</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-blue-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 28%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities List -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Activities -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Actividades de la Fase</h3>
            
            <!-- Activity 1 - Registrar Plan -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-blue-500">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-600">1</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-900">Actividad 1: Registrar Plan de Implementación PGE</h4>
                                <p class="text-sm text-gray-600 mt-1">Registrar oficialmente el Plan de Implementación aprobado por RD. Este plan es único para todas las entidades y no puede haber 2 planes en curso.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-500">Actor: Secretario CTPPGE</span>
                                    <span class="text-xs text-gray-500">Tiempo: 1 día</span>
                                </div>
                                <div class="mt-3">
                                    <span class="status-badge status-progress">Requerida</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between text-sm mb-3">
                            <span class="text-gray-500">Documentos requeridos:</span>
                            <span class="text-gray-700">RD de Aprobación + Plan en PDF</span>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('implementation-plans.index') }}" class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                Gestionar Planes de Implementación
                            </a>
                            <a href="{{ route('implementation-plans.create') }}" class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors">
                                Registrar Nuevo Plan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity 2 - Gestión del Órgano Colegiado -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-indigo-500">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-indigo-600">2</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-900">Actividad 2: Solicitar conformación del Órgano Colegiado</h4>
                                <p class="text-sm text-gray-600 mt-1">Gestión completa del proceso de conformación del Órgano Colegiado por entidad asignada.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-500">Actor: Sectorista / Secretario CTPPGE</span>
                                    <span class="text-xs text-gray-500">Tiempo: Variable por entidad</span>
                                </div>
                                <div class="mt-3">
                                    <span class="status-badge status-progress">En Progreso</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Flujo de Actividad 2 -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <h5 class="text-sm font-semibold text-gray-700 mb-3">Flujo del Proceso:</h5>
                        <div class="space-y-2 text-xs text-gray-600 mb-4">
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">1.</span>
                                <span>Visualizar entidades asignadas al sectorista</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">2.</span>
                                <span>Coordinar reuniones (registro, reprogramación, historial)</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">3.</span>
                                <span>Generar oficio de solicitud de conformación</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">4.</span>
                                <span>Seguimiento visual de acuerdos y compromisos</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">5.</span>
                                <span>Registrar acto resolutivo (PDF, fecha, número)</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">6.</span>
                                <span>Control de vencimientos y oficios de reiteración</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-indigo-600 mr-2">7.</span>
                                <span>Programar sesión de inducción post-aprobación</span>
                            </div>
                        </div>
                        
                        <!-- DEBUG TEMPORAL - ELIMINAR DESPUÉS -->
                        @if(auth()->check())
                            <div class="mt-2 p-2 bg-yellow-100 border border-yellow-300 rounded text-xs">
                                <strong>DEBUG:</strong> 
                                Usuario: {{ auth()->user()->email }} | 
                                Rol: {{ auth()->user()->role }} | 
                                Es Sectorista: {{ auth()->user()->isSectorista() ? 'SÍ' : 'NO' }}
                            </div>
                        @endif
                        <!-- FIN DEBUG -->
                        
                        <!-- Acciones Disponibles -->
                        @if(auth()->check() && auth()->user()->isSectorista())
                            <!-- SECTORISTAS: Vista completa de gestión -->
                            <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="{{ route('activity2.index', auth()->user()->sectorista_id ?? '') }}" 
                                       class="px-4 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors flex flex-col items-center gap-2 text-center shadow-sm">
                                        <span class="text-2xl">📋</span>
                                        <span>Mis Entidades</span>
                                    </a>
                                    
                                    <a href="{{ route('activity2.index', auth()->user()->sectorista_id ?? '') }}" 
                                       class="px-4 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors flex flex-col items-center gap-2 text-center shadow-sm">
                                        <span class="text-2xl">📊</span>
                                        <span>Seguimiento</span>
                                    </a>
                                </div>
                            </div>
                        @elseif(auth()->check() && (auth()->user()->isSecretarioCTPPGE() || auth()->user()->isAdmin()))
                            <!-- SECRETARIO/ADMIN: Vista de supervisión -->
                            <div class="flex justify-center">
                                <a href="{{ route('activity2.index') }}" 
                                   class="px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors inline-flex items-center gap-2 shadow-sm">
                                    📊 Seguimiento General de Entidades
                                </a>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-100">
                                <p class="text-xs text-gray-500 text-center mb-2">
                                    💡 Para asignar entidades a sectoristas, usa el módulo de administración
                                </p>
                            </div>
                        @else
                            <!-- OTROS ROLES: Vista básica -->
                            <div class="flex justify-center">
                                <a href="{{ route('activity2.index') }}" 
                                   class="px-6 py-3 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition-colors inline-flex items-center gap-2">
                                    👁️ Ver Actividad 2
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Activity 3 - Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 opacity-60">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">3</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-500">Actividad 3: Recepcionar resolución de conformación</h4>
                                <p class="text-sm text-gray-500 mt-1">Recepcionar la resolución de conformación del Órgano Colegiado en el SGD.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-400">Actor: Secretario CTPPGE</span>
                                    <span class="text-xs text-gray-400">Tiempo: 1 día</span>
                                </div>
                                <div class="mt-3">
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity 4 - Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 opacity-60">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">4</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-500">Actividad 4: Coordinar reunión de inicio</h4>
                                <p class="text-sm text-gray-500 mt-1">Coordinar y convocar reunión de inicio con los responsables de componentes.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-400">Actor: Secretario CTPPGE</span>
                                    <span class="text-xs text-gray-400">Tiempo: 1 hora</span>
                                </div>
                                <div class="mt-3">
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity 5 - Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 opacity-60">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">5</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-500">Actividad 5: Aprobar Plan de Trabajo preliminar</h4>
                                <p class="text-sm text-gray-500 mt-1">Revisar y aprobar el Plan de Trabajo preliminar durante la reunión de inicio.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-400">Actor: Órgano Colegiado</span>
                                    <span class="text-xs text-gray-400">Tiempo: 3 días</span>
                                </div>
                                <div class="mt-3">
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Phase Info -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de la Fase</h3>
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Duración</dt>
                            <dd class="text-sm text-gray-900">7 días hábiles</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Actividades</dt>
                            <dd class="text-sm text-gray-900">5 actividades secuenciales</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Actor Principal</dt>
                            <dd class="text-sm text-gray-900">Secretario CTPPGE</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Objetivo</dt>
                            <dd class="text-sm text-gray-900">Establecer el marco organizacional y aprobar el plan de trabajo</dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Documents -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Documentos Clave</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Plan PGE vigente</span>
                            </div>
                            <span class="text-xs text-green-600">Registrado</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-900">Oficio conformación</span>
                            </div>
                            <span class="text-xs text-blue-600">En proceso</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Resolución conformación</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0a4 4 0 100 8m0-8V9"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Acta Plan de Trabajo</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Próximos Pasos</h3>
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                            <p class="text-sm font-medium text-blue-900">Completar oficio de conformación</p>
                            <p class="text-xs text-blue-700 mt-1">Revisar plantilla y enviar para aprobación</p>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                            <p class="text-sm font-medium text-yellow-900">Preparar documentación</p>
                            <p class="text-xs text-yellow-700 mt-1">Reunir anexos necesarios para la resolución</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

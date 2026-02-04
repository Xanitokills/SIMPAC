@extends('layouts.dashboard')

@section('page-title', 'Etapa de Cierre')
@section('page-description', 'Fase 3: Cierre y evaluación del proceso de implementación')

@section('content')

<div class="space-y-6">
    <!-- Phase Overview -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 3: Etapa de Cierre</h2>
                    <p class="text-purple-100 mt-1">Duración estimada: 3 días hábiles</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-purple-100">Completado</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-purple-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities List -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Activities -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Actividades de la Fase</h3>
            
            <!-- Activity 1 - Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 opacity-60">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">1</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-500">Actividad 1: Elaborar informe final</h4>
                                <p class="text-sm text-gray-500 mt-1">Preparar el informe final del proceso de implementación con los resultados obtenidos.</p>
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

            <!-- Activity 2 - Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 opacity-60">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">2</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base font-semibold text-gray-500">Actividad 2: Evaluación de resultados</h4>
                                <p class="text-sm text-gray-500 mt-1">Evaluar los resultados obtenidos y el cumplimiento de los objetivos planteados.</p>
                                <div class="flex items-center space-x-4 mt-3">
                                    <span class="text-xs text-gray-400">Actor: Órgano Colegiado</span>
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
                                <h4 class="text-base font-semibold text-gray-500">Actividad 3: Archivar documentación</h4>
                                <p class="text-sm text-gray-500 mt-1">Archivar toda la documentación generada durante el proceso de implementación.</p>
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
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Key Documents -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Documentos Clave</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Informe Final</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Acta de Evaluación</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                                <span class="text-sm font-medium text-gray-500">Archivo Digital</span>
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
                        <div class="p-3 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                            <p class="text-sm font-medium text-purple-900">Completar fase de ejecución</p>
                            <p class="text-xs text-purple-700 mt-1">Finalizar todas las actividades pendientes antes del cierre</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                            <p class="text-sm font-medium text-blue-900">Recopilar evidencias</p>
                            <p class="text-xs text-blue-700 mt-1">Reunir toda la documentación generada en el proceso</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.dashboard')

@section('page-title', 'Validación y Cierre')
@section('page-description', 'Fase 3: Validación final por Órgano Colegiado y Procuraduría')

@section('content')
<div class="space-y-6">
    <!-- Phase Overview -->
    <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 3: Validación y Cierre</h2>
                    <p class="text-indigo-100 mt-1">Validación legal y cierre formal • 6 días estimados</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-indigo-100">Progreso de validación</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-indigo-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Process -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Component Validation Status -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado de Componentes</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Presupuesto</p>
                                <p class="text-xs text-gray-500">Componente 1</p>
                            </div>
                        </div>
                        <span class="status-badge status-pending">Pendiente</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Bienes y Servicios</p>
                                <p class="text-xs text-gray-500">Componente 2</p>
                            </div>
                        </div>
                        <span class="status-badge status-pending">Pendiente</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Acervo Documentario</p>
                                <p class="text-xs text-gray-500">Componente 3</p>
                            </div>
                        </div>
                        <span class="status-badge status-pending">Pendiente</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Tecnología TI</p>
                                <p class="text-xs text-gray-500">Componente 4</p>
                            </div>
                        </div>
                        <span class="status-badge status-pending">Pendiente</span>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Recursos Humanos</p>
                                <p class="text-xs text-gray-500">Componente 5</p>
                            </div>
                        </div>
                        <span class="status-badge status-pending">Pendiente</span>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-yellow-900">Esperando finalización de componentes</p>
                            <p class="text-xs text-yellow-700">La validación comenzará cuando todos los componentes estén completos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Validation Activities -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actividades de Validación</h3>
                <div class="space-y-4">
                    <!-- Activity 6 -->
                    <div class="p-4 border border-gray-200 rounded-lg opacity-60">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">6</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500">Revisar y validar componentes</h4>
                                <p class="text-xs text-gray-500 mt-1">Revisión integral por Órgano Colegiado + Procuraduría</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-400">Tiempo: 3 días</span>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 7 -->
                    <div class="p-4 border border-gray-200 rounded-lg opacity-60">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">7</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500">Suscribir actas de cierre</h4>
                                <p class="text-xs text-gray-500 mt-1">Firma de actas por Órgano Colegiado + Procuraduría</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-400">Tiempo: 2 días</span>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 8 -->
                    <div class="p-4 border border-gray-200 rounded-lg opacity-60">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">8</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500">Elaborar Acta de Cierre Final</h4>
                                <p class="text-xs text-gray-500 mt-1">Consolidación por Secretario CTPPGE</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-400">Tiempo: 1 día</span>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 9 -->
                    <div class="p-4 border border-gray-200 rounded-lg opacity-60">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">9</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500">Emitir Decreto Supremo</h4>
                                <p class="text-xs text-gray-500 mt-1">Formalización legal por Procuraduría</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-400">Tiempo: 3 días</span>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 10 -->
                    <div class="p-4 border border-gray-200 rounded-lg opacity-60">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-500">10</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-500">Publicar en El Peruano</h4>
                                <p class="text-xs text-gray-500 mt-1">Publicación oficial del Decreto</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-xs text-gray-400">Tiempo: 1 día</span>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Tools -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Checklist -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Lista de Verificación</h3>
                <div class="space-y-3">
                    <div class="text-sm">
                        <h4 class="font-medium text-gray-900 mb-2">Documentos requeridos:</h4>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" disabled>
                                <span class="text-gray-500">Actas de cierre de componentes (5)</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" disabled>
                                <span class="text-gray-500">Anexos técnicos</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" disabled>
                                <span class="text-gray-500">Base de datos actualizada</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" disabled>
                                <span class="text-gray-500">Validación legal</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legal Review -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Revisión Legal</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Procuraduría</p>
                                <p class="text-xs text-purple-700">Validación legal requerida</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p>La Procuraduría debe revisar y validar legalmente todos los documentos antes del cierre final.</p>
                    </div>
                    <button class="w-full bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors" disabled>
                        Solicitar Revisión Legal
                    </button>
                </div>
            </div>
        </div>

        <!-- Final Documents -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Documentos Finales</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm text-gray-600">Acta de Cierre Final</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="text-sm text-gray-600">Decreto Supremo</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <span class="text-sm text-gray-600">Publicación Oficial</span>
                            </div>
                            <span class="text-xs text-gray-500">Pendiente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Cronograma de Validación</h3>
            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <div class="space-y-8">
                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center z-10">
                            <span class="text-sm font-medium text-gray-600">1</span>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-base font-medium text-gray-500">Revisión integral (3 días)</h4>
                            <p class="text-sm text-gray-400">Órgano Colegiado + Procuraduría</p>
                        </div>
                    </div>

                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center z-10">
                            <span class="text-sm font-medium text-gray-600">2</span>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-base font-medium text-gray-500">Firma de actas (2 días)</h4>
                            <p class="text-sm text-gray-400">Suscripción formal</p>
                        </div>
                    </div>

                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center z-10">
                            <span class="text-sm font-medium text-gray-600">3</span>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-base font-medium text-gray-500">Decreto Supremo (3 días)</h4>
                            <p class="text-sm text-gray-400">Elaboración y aprobación</p>
                        </div>
                    </div>

                    <div class="relative flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center z-10">
                            <span class="text-sm font-medium text-gray-600">4</span>
                        </div>
                        <div class="ml-6">
                            <h4 class="text-base font-medium text-gray-500">Publicación (1 día)</h4>
                            <p class="text-sm text-gray-400">El Peruano</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

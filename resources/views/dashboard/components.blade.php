@extends('layouts.dashboard')

@section('page-title', 'Gestión de Componentes')
@section('page-description', 'Ejecución en paralelo de los 5 componentes del proceso de transferencia')

@section('content')
<div class="space-y-6">
    <!-- Components Overview -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Ejecución por Componentes</h2>
                    <p class="text-green-100 mt-1">5 componentes ejecutándose en paralelo • 5 días estimados</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-green-100">Progreso general</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Components Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Component 1: Presupuesto -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Presupuesto</h3>
                            <p class="text-sm text-gray-500">Componente 1</p>
                        </div>
                    </div>
                    <span class="status-badge status-pending">Pendiente</span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Responsable:</span>
                        <span class="text-gray-600">Responsable de Presupuesto</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Duración:</span>
                        <span class="text-gray-600">5 días</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Actividades:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Levantamiento de información presupuestal</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Validación de anexos</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Seguimiento y actualización en BD</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Documentos:</h4>
                    <div class="text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Anexo de Presupuesto</span>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>BD de seguimiento en Excel</span>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Iniciar Componente
                </button>
            </div>
        </div>

        <!-- Component 2: Bienes y Servicios -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Bienes y Servicios</h3>
                            <p class="text-sm text-gray-500">Componente 2</p>
                        </div>
                    </div>
                    <span class="status-badge status-pending">Pendiente</span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Responsable:</span>
                        <span class="text-gray-600">Responsable de Bienes y Servicios</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Duración:</span>
                        <span class="text-gray-600">5 días</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Actividades:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Inventario y levantamiento de bienes</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Validación de conformidad</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Emisión de acta de cierre</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Documentos:</h4>
                    <div class="text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Acta de cierre – Bienes y Servicios</span>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <button class="w-full bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Iniciar Componente
                </button>
            </div>
        </div>

        <!-- Component 3: Acervo Documentario -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Acervo Documentario</h3>
                            <p class="text-sm text-gray-500">Componente 3</p>
                        </div>
                    </div>
                    <span class="status-badge status-pending">Pendiente</span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Responsable:</span>
                        <span class="text-gray-600">Responsable de Acervo Documentario</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Duración:</span>
                        <span class="text-gray-600">5 días</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Actividades:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Custodia y digitalización del acervo</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Registro en carpeta compartida</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Actualización del Excel compartido</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Documentos:</h4>
                    <div class="text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                            </svg>
                            <span>BD de acervo digital</span>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>Excel de registro</span>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <button class="w-full bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Iniciar Componente
                </button>
            </div>
        </div>

        <!-- Component 4: Tecnología de la Información -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Tecnología de la Información</h3>
                            <p class="text-sm text-gray-500">Componente 4</p>
                        </div>
                    </div>
                    <span class="status-badge status-pending">Pendiente</span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Responsable:</span>
                        <span class="text-gray-600">Responsable de TI</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Duración:</span>
                        <span class="text-gray-600">5 días</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Actividades:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Instalación y configuración de sistemas</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Seguimiento al plan de trabajo</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Emisión de acta de cierre</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Documentos:</h4>
                    <div class="text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Acta de cierre – TI</span>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-cyan-600 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <button class="w-full bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Iniciar Componente
                </button>
            </div>
        </div>

        <!-- Component 5: Recursos Humanos -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recursos Humanos</h3>
                            <p class="text-sm text-gray-500">Componente 5</p>
                        </div>
                    </div>
                    <span class="status-badge status-pending">Pendiente</span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Responsable:</span>
                        <span class="text-gray-600">Responsable de RRHH</span>
                    </div>
                    <div class="text-sm">
                        <span class="font-medium text-gray-700">Duración:</span>
                        <span class="text-gray-600">5 días</span>
                    </div>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Actividades:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Levantamiento de personal asignado</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Validación de nóminas y cargos</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            <span>Emisión de acta de cierre</span>
                        </li>
                    </ul>
                </div>

                <div class="space-y-2 mb-4">
                    <h4 class="text-sm font-medium text-gray-900">Documentos:</h4>
                    <div class="text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Acta de cierre – RRHH</span>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-teal-600 h-2 rounded-full" style="width: 0%"></div>
                </div>

                <button class="w-full bg-slate-600 hover:bg-slate-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Iniciar Componente
                </button>
            </div>
        </div>

        <!-- Control Panel -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 md:col-span-2 xl:col-span-3">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Panel de Control</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-gray-900">Acciones Globales</h4>
                        <div class="space-y-2">
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                Iniciar Todos los Componentes
                            </button>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                Generar Informe de Estado
                            </button>
                            <button class="w-full bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                Programar Seguimiento
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-gray-900">Base de Datos Compartida</h4>
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Excel Compartido</p>
                                    <p class="text-xs text-blue-700">Actualización en tiempo real</p>
                                </div>
                            </div>
                            <button class="mt-3 w-full bg-blue-600 hover:bg-blue-700 text-white text-xs py-2 px-3 rounded transition-colors">
                                Acceder a BD
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-gray-900">Próximas Reuniones</h4>
                        <div class="space-y-2">
                            <div class="p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                                <p class="text-sm font-medium text-yellow-900">Seguimiento Semanal</p>
                                <p class="text-xs text-yellow-700">Viernes 8:00 AM</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-lg border-l-4 border-slate-500">
                                <p class="text-sm font-medium text-slate-900">Validación Procuraduría</p>
                                <p class="text-xs text-slate-700">Por agendar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('page-title', 'Cronograma')
@section('page-description', 'Cronograma completo del proceso de transferencia PGE')

@section('content')
<div class="space-y-6">
    <!-- Timeline Overview -->
    <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Cronograma del Proceso</h2>
                    <p class="text-cyan-100 mt-1">18 días hábiles estimados • 3 fases principales</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">25%</div>
                    <div class="text-sm text-cyan-100">Tiempo transcurrido</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-cyan-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 25%"></div>
                </div>
                <div class="flex justify-between text-xs text-cyan-100 mt-2">
                    <span>Día 1</span>
                    <span>Día 5 actual</span>
                    <span>Día 18</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Phase Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-blue-600">1</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Inicio y Planificación</h3>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Duración:</span>
                    <span class="font-medium">7 días</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Progreso:</span>
                    <span class="font-medium text-blue-600">40% (Día 3 de 7)</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: 40%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-gray-400">2</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-500">Ejecución Componentes</h3>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Duración:</span>
                    <span class="font-medium">5 días</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Estado:</span>
                    <span class="font-medium text-gray-500">Pendiente</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold text-gray-400">3</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-500">Validación y Cierre</h3>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Duración:</span>
                    <span class="font-medium">6 días</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Estado:</span>
                    <span class="font-medium text-gray-500">Pendiente</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Timeline -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Cronograma Detallado</h3>
                <div class="flex space-x-3">
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                        <option>Ver todas las fases</option>
                        <option>Solo fase actual</option>
                        <option>Próximas actividades</option>
                    </select>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                        Exportar
                    </button>
                </div>
            </div>

            <div class="relative">
                <!-- Timeline line -->
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                <!-- Phase 1 Activities -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-sm font-semibold mr-4">
                            FASE 1
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">Inicio y Planificación (7 días)</h4>
                    </div>

                    <!-- Activity 1 - Completed -->
                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-green-600 rounded-full mt-2 z-10 border-2 border-white"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-500">
                                <div class="flex items-center justify-between mb-2">
                                    <h5 class="text-sm font-semibold text-green-900">Actividad 1: Registrar Plan de Implementación PGE</h5>
                                    <span class="status-badge status-completed">Completado</span>
                                </div>
                                <p class="text-xs text-green-700 mb-2">Secretario CTPPGE • 1 día estimado</p>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-green-600">📅 Día 1 (05/10/2024)</span>
                                    <span class="text-green-600">✅ Completado a tiempo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 2 - In Progress -->
                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-blue-600 rounded-full mt-2 z-10 border-2 border-white animate-pulse"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                                <div class="flex items-center justify-between mb-2">
                                    <h5 class="text-sm font-semibold text-blue-900">Actividad 2: Solicitar conformación del Órgano Colegiado</h5>
                                    <span class="status-badge status-progress">En Progreso</span>
                                </div>
                                <p class="text-xs text-blue-700 mb-2">Secretario CTPPGE • 1 día estimado</p>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-blue-600">📅 Día 2 (06/10/2024) - Actual</span>
                                    <span class="text-blue-600">⏱️ En progreso</span>
                                </div>
                                <div class="mt-2 w-full bg-blue-200 rounded-full h-1">
                                    <div class="bg-blue-600 h-1 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity 3 - Pending -->
                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-gray-300 rounded-full mt-2 z-10 border-2 border-white"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-gray-300">
                                <div class="flex items-center justify-between mb-2">
                                    <h5 class="text-sm font-semibold text-gray-700">Actividad 3: Recepcionar resolución de conformación</h5>
                                    <span class="status-badge status-pending">Pendiente</span>
                                </div>
                                <p class="text-xs text-gray-600 mb-2">Secretario CTPPGE • 1 día estimado</p>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">📅 Día 3 (07/10/2024)</span>
                                    <span class="text-gray-500">⏳ Esperando</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activities 4 & 5 - Pending -->
                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-gray-300 rounded-full mt-2 z-10 border-2 border-white"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-gray-300">
                                <h5 class="text-sm font-semibold text-gray-700 mb-2">Actividades 4-5: Reunión y aprobación Plan de Trabajo</h5>
                                <p class="text-xs text-gray-600 mb-2">Secretario CTPPGE + Órgano Colegiado • 4 días estimados</p>
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500">📅 Días 4-7 (08-11/10/2024)</span>
                                    <span class="text-gray-500">⏳ Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phase 2 -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-8 bg-gray-400 rounded-lg flex items-center justify-center text-white text-sm font-semibold mr-4">
                            FASE 2
                        </div>
                        <h4 class="text-lg font-semibold text-gray-500">Ejecución por Componentes (5 días)</h4>
                    </div>

                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-gray-300 rounded-full mt-2 z-10 border-2 border-white"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-gray-300">
                                <h5 class="text-sm font-semibold text-gray-700 mb-2">Ejecución en paralelo de 5 componentes</h5>
                                <div class="grid grid-cols-1 md:grid-cols-5 gap-2 text-xs text-gray-600">
                                    <div>• Presupuesto</div>
                                    <div>• Bienes y Servicios</div>
                                    <div>• Acervo Documentario</div>
                                    <div>• Tecnología TI</div>
                                    <div>• Recursos Humanos</div>
                                </div>
                                <div class="flex items-center justify-between text-xs mt-2">
                                    <span class="text-gray-500">📅 Días 8-12 (14-18/10/2024)</span>
                                    <span class="text-gray-500">⏳ Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phase 3 -->
                <div class="mb-8">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-8 bg-gray-400 rounded-lg flex items-center justify-center text-white text-sm font-semibold mr-4">
                            FASE 3
                        </div>
                        <h4 class="text-lg font-semibold text-gray-500">Validación y Cierre (6 días)</h4>
                    </div>

                    <div class="relative flex items-start mb-6">
                        <div class="flex-shrink-0 w-4 h-4 bg-gray-300 rounded-full mt-2 z-10 border-2 border-white"></div>
                        <div class="ml-6 flex-1">
                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-gray-300">
                                <h5 class="text-sm font-semibold text-gray-700 mb-2">Validación, cierre y formalización</h5>
                                <div class="text-xs text-gray-600 space-y-1">
                                    <div>• Revisión y validación por Órgano Colegiado + Procuraduría</div>
                                    <div>• Suscripción de actas de cierre</div>
                                    <div>• Elaboración de Acta de Cierre Final</div>
                                    <div>• Decreto Supremo y publicación en El Peruano</div>
                                </div>
                                <div class="flex items-center justify-between text-xs mt-2">
                                    <span class="text-gray-500">📅 Días 13-18 (21-26/10/2024)</span>
                                    <span class="text-gray-500">⏳ Pendiente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Critical Path & Dependencies -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Critical Path -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ruta Crítica</h3>
                <div class="space-y-3">
                    <div class="p-3 bg-red-50 rounded-lg border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-red-900">Oficio de conformación</p>
                                <p class="text-xs text-red-700">Bloquea inicio de Fase 2</p>
                            </div>
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-yellow-900">Resolución de conformación</p>
                                <p class="text-xs text-yellow-700">Dependencia externa</p>
                            </div>
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-blue-900">Plan de Trabajo aprobado</p>
                                <p class="text-xs text-blue-700">Habilita ejecución</p>
                            </div>
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Próximos Hitos</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-blue-900">Finalizar oficio conformación</p>
                            <p class="text-xs text-blue-700">Hoy - 06/10/2024</p>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded">HOY</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Recibir resolución</p>
                            <p class="text-xs text-gray-600">Mañana - 07/10/2024</p>
                        </div>
                        <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-1 rounded">1 DÍA</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Reunión de inicio</p>
                            <p class="text-xs text-gray-600">08/10/2024</p>
                        </div>
                        <span class="text-xs font-semibold text-gray-600 bg-gray-100 px-2 py-1 rounded">2 DÍAS</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-green-900">Inicio Fase 2</p>
                            <p class="text-xs text-green-700">14/10/2024</p>
                        </div>
                        <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded">8 DÍAS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar View -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Vista de Calendario - Octubre 2024</h3>
            <div class="grid grid-cols-7 gap-1 text-center text-xs">
                <!-- Calendar headers -->
                <div class="p-3 font-semibold text-gray-600">Lun</div>
                <div class="p-3 font-semibold text-gray-600">Mar</div>
                <div class="p-3 font-semibold text-gray-600">Mié</div>
                <div class="p-3 font-semibold text-gray-600">Jue</div>
                <div class="p-3 font-semibold text-gray-600">Vie</div>
                <div class="p-3 font-semibold text-gray-600">Sáb</div>
                <div class="p-3 font-semibold text-gray-600">Dom</div>

                <!-- Calendar days -->
                <div class="p-3 text-gray-400">30</div>
                <div class="p-3 text-gray-400">1</div>
                <div class="p-3 text-gray-400">2</div>
                <div class="p-3 text-gray-400">3</div>
                <div class="p-3 text-gray-400">4</div>
                <div class="p-3 bg-green-100 text-green-800 rounded font-semibold">5<br/>✅ Act.1</div>
                <div class="p-3 text-gray-400">6</div>

                <div class="p-3 text-gray-400">7</div>
                <div class="p-3 bg-blue-100 text-blue-800 rounded font-semibold border-2 border-blue-500">6<br/>🔄 Act.2</div>
                <div class="p-3 bg-yellow-100 text-yellow-800 rounded">7<br/>📋 Act.3</div>
                <div class="p-3 bg-gray-100 text-gray-600 rounded">8<br/>📝 Act.4</div>
                <div class="p-3 bg-gray-100 text-gray-600 rounded">9<br/>📝 Act.4</div>
                <div class="p-3 bg-gray-100 text-gray-600 rounded">10<br/>📝 Act.4</div>
                <div class="p-3 bg-gray-100 text-gray-600 rounded">11<br/>✅ Act.5</div>

                <div class="p-3 text-gray-400">14</div>
                <div class="p-3 bg-purple-100 text-purple-800 rounded">15<br/>🚀 Fase 2</div>
                <div class="p-3 bg-purple-100 text-purple-800 rounded">16<br/>⚡ Comp.</div>
                <div class="p-3 bg-purple-100 text-purple-800 rounded">17<br/>⚡ Comp.</div>
                <div class="p-3 bg-purple-100 text-purple-800 rounded">18<br/>⚡ Comp.</div>
                <div class="p-3 text-gray-400">19</div>
                <div class="p-3 text-gray-400">20</div>

                <div class="p-3 bg-indigo-100 text-indigo-800 rounded">21<br/>🔍 Valid.</div>
                <div class="p-3 bg-indigo-100 text-indigo-800 rounded">22<br/>🔍 Valid.</div>
                <div class="p-3 bg-indigo-100 text-indigo-800 rounded">23<br/>🔍 Valid.</div>
                <div class="p-3 bg-indigo-100 text-indigo-800 rounded">24<br/>🔍 Valid.</div>
                <div class="p-3 bg-indigo-100 text-indigo-800 rounded">25<br/>🔍 Valid.</div>
                <div class="p-3 bg-green-100 text-green-800 rounded">26<br/>🎉 Cierre</div>
                <div class="p-3 text-gray-400">27</div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('page-title', 'Ejecución Plan de Acción')
@section('page-description', 'Fase 2: Ejecución paralela de los 5 componentes del proceso de transferencia')

@section('content')
<div class="space-y-6">
    {{-- Phase Overview - Comentado hasta que se seleccione una entidad --}}
    {{-- <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 2: Ejecución por Componentes</h2>
                    <p class="text-slate-100 mt-1">Ejecución en paralelo • 5 días estimados</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-slate-100">Progreso general</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-slate-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Progress Overview - Comentado hasta que se seleccione una entidad --}}
    {{-- <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Presupuesto</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Bienes y Servicios</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-teal-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Acervo Documentario</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Tecnología TI</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-cyan-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Recursos Humanos</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-slate-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Execution Status - Comentado hasta que se seleccione una entidad --}}
    {{--
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Current Status -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado Actual</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-base font-medium text-yellow-900">Esperando aprobación para iniciar</h4>
                                <p class="text-sm text-yellow-700 mt-1">Los componentes están listos para comenzar</p>
                            </div>
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-900">Prerequisitos completados:</h4>
                        <ul class="space-y-2">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Órgano Colegiado conformado</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Plan de Trabajo aprobado</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Responsables asignados</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Base de datos configurada</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Execution -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Iniciar Ejecución</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-base font-medium text-blue-900 mb-2">¿Listo para comenzar?</h4>
                        <p class="text-sm text-blue-700 mb-4">
                            Al iniciar la ejecución, todos los componentes comenzarán sus actividades en paralelo. 
                            Asegúrate de que todos los responsables estén disponibles.
                        </p>
                        <div class="space-y-3">
                            <button class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-9-4a9 9 0 105.293 8.293L12 19l-2.293-2.293A9 9 0 015 10z"/>
                                </svg>
                                <span>Iniciar Todos los Componentes</span>
                            </button>
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                Iniciar Componentes Selectivamente
                            </button>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <h5 class="text-sm font-medium text-gray-900 mb-3">Opciones de seguimiento:</h5>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm text-gray-700">Notificaciones automáticas</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                                <span class="text-sm text-gray-700">Actualizaciones diarias</span>
                            </label>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Reportes semanales</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Component Details -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Detalle de Componentes</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Componente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividades</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documentos</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Presupuesto</div>
                                        <div class="text-sm text-gray-500">Componente 1</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Responsable de Presupuesto</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <ul class="text-xs space-y-1">
                                    <li>• Levantamiento información</li>
                                    <li>• Validación anexos</li>
                                    <li>• Actualización BD</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="text-xs space-y-1">
                                    <div>• Anexo Presupuesto</div>
                                    <div>• BD Excel</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge status-pending">Pendiente</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900">Iniciar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Bienes y Servicios</div>
                                        <div class="text-sm text-gray-500">Componente 2</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Responsable de Bienes</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <ul class="text-xs space-y-1">
                                    <li>• Inventario bienes</li>
                                    <li>• Validación conformidad</li>
                                    <li>• Acta de cierre</li>
                                </ul>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="text-xs">• Acta cierre Bienes</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge status-pending">Pendiente</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900">Iniciar</button>
                            </td>
                        </tr>
                        <!-- More rows for other components... -->
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <!-- 
    ====================================================================
    SELECTOR DE ENTIDAD - Flujo de trabajo
    El usuario debe seleccionar una entidad antes de acceder a reuniones y seguimiento
    ====================================================================
    -->

    {{-- ========================================
         RESUMEN DE ALERTAS Y ESTADÍSTICAS (PRIMERO)
         Panel de resumen para visualización rápida del estado general
    ========================================= --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Resumen de Estado General
                </h3>
                <span class="text-xs text-gray-500">Última actualización: {{ now()->format('d M Y, H:i') }}</span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Vencidos --}}
                <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 border border-slate-200 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-800">Vencidos</p>
                            <p class="text-3xl font-bold text-slate-700 mt-1">3</p>
                            <p class="text-xs text-slate-600 mt-1">Requieren atención inmediata</p>
                        </div>
                        <div class="w-14 h-14 bg-slate-200 rounded-full flex items-center justify-center group-hover:bg-slate-300 transition-colors">
                            <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Próximos a vencer --}}
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl p-5 border border-amber-200 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-amber-800">Próximos a vencer</p>
                            <p class="text-3xl font-bold text-amber-700 mt-1">5</p>
                            <p class="text-xs text-amber-600 mt-1">En los próximos 7 días</p>
                        </div>
                        <div class="w-14 h-14 bg-amber-200 rounded-full flex items-center justify-center group-hover:bg-amber-300 transition-colors">
                            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Pendientes --}}
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5 border border-blue-200 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-800">Pendientes</p>
                            <p class="text-3xl font-bold text-blue-700 mt-1">8</p>
                            <p class="text-xs text-blue-600 mt-1">En espera de respuesta</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-200 rounded-full flex items-center justify-center group-hover:bg-blue-300 transition-colors">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Completados --}}
                <div class="bg-gradient-to-br from-green-50 to-emerald-100 rounded-xl p-5 border border-green-200 hover:shadow-md transition-shadow cursor-pointer group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-green-800">Completados</p>
                            <p class="text-3xl font-bold text-green-700 mt-1">12</p>
                            <p class="text-xs text-green-600 mt-1">Finalizados exitosamente</p>
                        </div>
                        <div class="w-14 h-14 bg-green-200 rounded-full flex items-center justify-center group-hover:bg-green-300 transition-colors">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tarjetas de Entidades Asignadas --}}
    @if(isset($assignedEntities) && $assignedEntities->count() > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Entidades Asignadas</h3>
                    <p class="text-sm text-gray-500">Haga clic en una entidad para acceder a su panel de seguimiento</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-800">
                    {{ $assignedEntities->count() }} Entidades Asignadas
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($assignedEntities as $entity)
                    @php
                        $assignment = \App\Models\EntityAssignment::where('entity_id', $entity->id)
                            ->with(['sectorista', 'entity', 'actionPlan', 'meetings', 'oficios'])
                            ->first();
                        
                        // Contar reuniones, oficios, etc.
                        $reunionesCount = $assignment ? $assignment->meetings->count() : 0;
                        $oficiosCount = $assignment ? $assignment->oficios->count() : 0;
                        $hasActionPlan = $assignment && $assignment->actionPlan ? 1 : 0;
                        
                        // Determinar el tipo y color
                        $entityType = $entity->type ?? 'gobierno';
                        $entityTypeLabel = match($entityType) {
                            'ministerio' => 'Ministerio',
                            'organismo_publico' => 'Organismo Público',
                            'gobierno_regional' => 'Gobierno Regional',
                            'gobierno_local' => 'Gobierno Local',
                            default => 'Entidad'
                        };
                        $entityScope = $entity->scope ?? 'Nacional';
                    @endphp
                    
                    @if($assignment)
                    <a href="{{ route('execution.entity', $assignment->id) }}" 
                       class="block bg-white rounded-lg border border-gray-200 hover:border-slate-300 hover:shadow-lg transition-all duration-200 overflow-hidden group">
                        {{-- Header de la tarjeta --}}
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 group-hover:text-slate-600 transition-colors mb-2">
                                {{ $entity->name }}
                            </h4>
                            
                            {{-- Badges de tipo y ámbito --}}
                            <div class="flex flex-wrap gap-1 mb-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700">
                                    {{ $entityTypeLabel }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                    {{ $entityScope }}
                                </span>
                            </div>
                            
                            {{-- Estadísticas --}}
                            <div class="space-y-1 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Plan de Acción:</span>
                                    <span class="font-medium text-gray-900">{{ $hasActionPlan ? 'Sí' : 'No' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Reuniones:</span>
                                    <span class="font-medium text-gray-900">{{ $reunionesCount }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Oficios:</span>
                                    <span class="font-medium text-gray-900">{{ $oficiosCount }}</span>
                                </div>
                            </div>
                            
                            {{-- Estado --}}
                            <div class="mt-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    En Progreso
                                </span>
                            </div>
                        </div>
                        
                        {{-- Botón de acción --}}
                        <div class="bg-gradient-to-r from-slate-600 to-slate-700 px-4 py-3 text-center group-hover:from-slate-700 group-hover:to-slate-800 transition-all">
                            <span class="text-white font-medium text-sm">Ver Detalles</span>
                        </div>
                        
                        {{-- Sectorista (para admin/secretario) --}}
                        @if(Auth::user()->role !== 'sectorista' && $assignment->sectorista)
                        <div class="px-4 py-2 bg-gray-50 border-t border-gray-100">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Sectorista: {{ $assignment->sectorista->name }}
                            </div>
                        </div>
                        @endif
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @else
    {{-- Mensaje cuando no hay entidades --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay entidades asignadas</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                @if(Auth::user()->role === 'sectorista')
                    Actualmente no tiene entidades asignadas. Contacte al administrador para recibir asignaciones.
                @else
                    No hay entidades con asignación en el sistema. Primero debe asignar entidades a sectoristas.
                @endif
            </p>
        </div>
    </div>
    @endif

    {{-- ========================================
         MÓDULOS DE SEGUIMIENTO - COMENTADO TEMPORALMENTE
         Vista previa de módulos disponibles después de seleccionar entidad
    ========================================= --}}
    {{--
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Módulos de Seguimiento</h3>
                <p class="text-gray-500 mb-6">Una vez que seleccione una entidad, podrá acceder a:</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 max-w-3xl mx-auto">
                    <!-- Preview Reuniones -->
                    <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6 opacity-60">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Reuniones de Coordinación</h4>
                        <p class="text-sm text-gray-600">Programar y gestionar reuniones con presentación de propuestas por componente</p>
                    </div>
                    
                    <!-- Preview Notificaciones -->
                    <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-6 opacity-60">
                        <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Notificaciones y Seguimiento</h4>
                        <p class="text-sm text-gray-600">Gestionar notificaciones por falta de respuesta y evidencias de seguimiento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}

    <!-- 
    ====================================================================
    MÓDULOS COMENTADOS TEMPORALMENTE
    Se activarán después de seleccionar la entidad
    ====================================================================
    -->
    
    {{-- <!-- Módulo 1: Reunión de Coordinación y Presentación de Propuesta -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Reunión de Coordinación y Presentación de Propuesta</h3>
                    <p class="text-sm text-gray-500 mt-1">Programar y gestionar reuniones con sectoristas para la presentación de propuestas</p>
                </div>
                <a href="{{ route('execution.meetings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Programar Reunión</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Programada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sectorista</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Componentes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200"> 
                        <!-- Ejemplo de reunión programada -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="font-medium">25 Nov 2025, 10:00 AM</div>
                                <div class="text-xs text-gray-500">En 7 días</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Juan Carlos Pérez</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">MEF - Ministerio de Economía</td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="flex flex-wrap gap-1">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Presupuesto</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-800">Bienes</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Programada
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('execution.meetings.show', 1) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                <a href="{{ route('execution.meetings.edit', 1) }}" class="text-slate-600 hover:text-slate-900">Editar</a>
                            </td>
                        </tr>
                        
                        <!-- Estado: Sin reuniones programadas -->
                        <tr class="bg-gray-50">
                            <td colspan="6" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">No hay reuniones programadas</p>
                                    <a href="{{ route('execution.meetings.create') }}" class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        Programar primera reunión
                                    </a>
                                </div>
                            </td>
                        </tr>
                    {{-- </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    {{-- <!-- Módulo 2: Notificaciones y Seguimiento de Respuestas --> --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Notificaciones y Seguimiento de Respuestas</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestión de notificaciones por falta de respuesta y seguimiento de evidencias</p>
                </div>
                <a href="{{ route('execution.notifications.create') }}" class="bg-slate-600 hover:bg-slate-700 text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>Crear Notificación</span>
                </a>
            </div>

            <!-- Filtros y búsqueda -->
            <div class="mb-4 flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" placeholder="Buscar por entidad o sectorista..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent">
                </div>
                <div class="flex gap-2">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent">
                        <option value="">Todos los estados</option>
                        <option value="pending">Pendiente de respuesta</option>
                        <option value="notified">Notificado</option>
                        <option value="responded">Con respuesta</option>
                        <option value="overdue">Vencido</option>
                    </select>
                    <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tabla de notificaciones -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entidad / Sectorista</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Solicitud Original</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notificaciones</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencia</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Ejemplo: Caso vencido sin respuesta -->
                        <tr class="hover:bg-amber-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">SUNAT</div>
                                <div class="text-xs text-gray-500">Sectorista: Juan Pérez</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium">Oficio N° 001-2025</div>
                                <div class="text-xs text-gray-500">Solicitud de información</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-amber-600">15 Nov 2025</div>
                                <div class="text-xs text-amber-500">Vencido hace 3 días</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center space-x-1">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">2</span>
                                    <span class="text-xs text-gray-500">enviadas</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Vencido
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    Adjuntar
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('execution.notifications.show', 1) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                <button class="text-amber-600 hover:text-amber-900">Notificar</button>
                            </td>
                        </tr>

                        <!-- Ejemplo: Caso con respuesta recibida -->
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">MEF</div>
                                <div class="text-xs text-gray-500">Sectorista: María Rodríguez</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="font-medium">Oficio N° 002-2025</div>
                                <div class="text-xs text-gray-500">Convocatoria reunión</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">20 Nov 2025</div>
                                <div class="text-xs text-gray-500">En 2 días</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center space-x-1">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-800 text-xs font-bold">1</span>
                                    <span class="text-xs text-gray-500">enviada</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Con respuesta
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="#" class="inline-flex items-center px-3 py-1 border border-green-300 rounded-md text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Ver (3)
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('execution.notifications.show', 2) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                            </td>
                        </tr>

                        <!-- Estado vacío -->
                        <tr class="bg-gray-50">
                            <td colspan="7" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">No hay notificaciones pendientes</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación y acciones rápidas -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Mostrando <span class="font-medium">1-3</span> de <span class="font-medium">28</span> notificaciones
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50" disabled>
                        Anterior
                    </button>
                    <button class="px-3 py-1 text-sm border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection

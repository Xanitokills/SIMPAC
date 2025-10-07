@extends('layouts.dashboard')

@section('page-title', 'Ejecución por Componentes')
@section('page-description', 'Fase 2: Ejecución paralela de los 5 componentes del proceso de transferencia')

@section('content')
<div class="space-y-6">
    <!-- Phase Overview -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 2: Ejecución por Componentes</h2>
                    <p class="text-purple-100 mt-1">Ejecución en paralelo • 5 días estimados</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-purple-100">Progreso general</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-purple-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
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
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Bienes y Servicios</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 0%"></div>
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
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Tecnología TI</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-900">Recursos Humanos</h3>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">0% completado</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Execution Status -->
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
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    </div>
</div>
@endsection

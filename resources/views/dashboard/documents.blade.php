@extends('layouts.dashboard')

@section('page-title', 'Gestión de Documentos')
@section('page-description', 'Documentos clave del proceso de transferencia PGE')

@section('content')
<div class="space-y-6">
    <!-- Documents Overview -->
    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Gestión de Documentos</h2>
                    <p class="text-emerald-100 mt-1">12 tipos de documentos • Sistema SGD integrado</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">8%</div>
                    <div class="text-sm text-emerald-100">Documentos completados</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Categories -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Input Documents -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Documentos de Entrada</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-900">Plan de Implementación PGE</span>
                        </div>
                        <span class="text-xs text-green-600 font-medium">Registrado</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm text-gray-500">Resolución de conformación</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Process Documents -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Documentos de Proceso</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                            </svg>
                            <span class="text-sm text-gray-900">Oficio de conformación</span>
                        </div>
                        <span class="text-xs text-blue-600 font-medium">En elaboración</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4"/>
                            </svg>
                            <span class="text-sm text-gray-500">Acta Plan de Trabajo</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5"/>
                            </svg>
                            <span class="text-sm text-gray-500">Anexos de componentes</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Output Documents -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Documentos de Salida</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                            </svg>
                            <span class="text-sm text-gray-500">Actas de cierre (5)</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6"/>
                            </svg>
                            <span class="text-sm text-gray-500">Acta de Cierre Final</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944"/>
                            </svg>
                            <span class="text-sm text-gray-500">Decreto Supremo</span>
                        </div>
                        <span class="text-xs text-gray-500">Pendiente</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Management Tools -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Document Generator -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Generador de Documentos</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="text-base font-medium text-blue-900 mb-2">Plantillas Disponibles</h4>
                        <div class="space-y-3">
                            <button class="w-full text-left p-3 bg-white rounded border border-blue-200 hover:border-blue-300 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Oficio de Conformación</p>
                                        <p class="text-xs text-gray-500">Solicitud Órgano Colegiado</p>
                                    </div>
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                            </button>
                            
                            <button class="w-full text-left p-3 bg-white rounded border border-gray-200 hover:border-gray-300 transition-colors opacity-60" disabled>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Acta de Reunión</p>
                                        <p class="text-xs text-gray-400">Plan de Trabajo</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0h-2"/>
                                    </svg>
                                </div>
                            </button>
                            
                            <button class="w-full text-left p-3 bg-white rounded border border-gray-200 hover:border-gray-300 transition-colors opacity-60" disabled>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Anexo Técnico</p>
                                        <p class="text-xs text-gray-400">Por componente</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0h-2"/>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                            Nuevo Documento
                        </button>
                        <button class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                            Ver Plantillas
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SGD Integration -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Integración SGD</h3>
                <div class="space-y-4">
                    <div class="p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center space-x-3 mb-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-green-900">Conexión activa con SGD</span>
                        </div>
                        <div class="text-xs text-green-700 space-y-1">
                            <p>• Sincronización automática</p>
                            <p>• Trazabilidad completa</p>
                            <p>• Validación en tiempo real</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                            Sincronizar con SGD
                        </button>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs py-2 px-3 rounded transition-colors">
                                Exportar Documentos
                            </button>
                            <button class="bg-purple-600 hover:bg-purple-700 text-white text-xs py-2 px-3 rounded transition-colors">
                                Ver Historial
                            </button>
                        </div>
                    </div>
                    
                    <div class="pt-3 border-t border-gray-200">
                        <div class="text-xs text-gray-500 space-y-1">
                            <div class="flex justify-between">
                                <span>Última sincronización:</span>
                                <span>Hace 5 min</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Documentos en SGD:</span>
                                <span>1 de 12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Document Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Registro de Documentos</h3>
                <div class="flex space-x-3">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                        Filtrar
                    </button>
                    <button class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                        Exportar
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Plan de Implementación PGE vigente</div>
                                        <div class="text-sm text-gray-500">DOC-001-2024</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Entrada</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Secretaría General</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge status-completed">Registrado</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">05/10/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Ver</button>
                                <button class="text-green-600 hover:text-green-900">Descargar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Oficio de solicitud de conformación</div>
                                        <div class="text-sm text-gray-500">DOC-002-2024</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Proceso</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Secretario CTPPGE</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-badge status-progress">En elaboración</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">06/10/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Editar</button>
                                <button class="text-gray-400">Descargar</button>
                            </td>
                        </tr>
                        <!-- More document rows would go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

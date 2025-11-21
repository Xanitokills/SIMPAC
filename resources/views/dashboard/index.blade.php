@extends('layouts.dashboard')

@section('page-title', 'Panel Principal')
@section('page-description', 'Sistema de Transferencia según Plan de Implementación PGE vigente')

@section('content')

<div class="space-y-6">
    <!-- Welcome Alert -->    @if(session('success'))    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">        <div class="flex items-center">            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>            </svg>            <div>                <p class="font-semibold text-green-900">{{ session('success') }}</p>                <p class="text-sm text-green-700">Rol: {{ session('user_role', 'Usuario') }}</p>            </div>        </div>    </div>    @endif    <!-- Stats Overview - Tiempos según doc1.txt (línea 151-155) -->    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">        <!-- Fase 1: Planificación -->        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">            <div class="flex items-center justify-between mb-3">                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>                    </svg>                </div>                <span class="text-4xl font-bold">7</span>            </div>            <h3 class="text-sm font-medium opacity-90">Fase 1: Planificación</h3>            <p class="text-xs opacity-75">días hábiles • 3 actividades</p>        </div>        <!-- Fase 2: Ejecución -->        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">            <div class="flex items-center justify-between mb-3">                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>                    </svg>                </div>                <span class="text-4xl font-bold">5</span>            </div>            <h3 class="text-sm font-medium opacity-90">Fase 2: Ejecución</h3>            <p class="text-xs opacity-75">días (paralelos) • 5 componentes</p>        </div>        <!-- Fase 3: Validación -->        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">            <div class="flex items-center justify-between mb-3">                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>                    </svg>                </div>                <span class="text-4xl font-bold">6</span>            </div>            <h3 class="text-sm font-medium opacity-90">Fase 3: Validación</h3>            <p class="text-xs opacity-75">días hábiles • 5 actividades</p>        </div>        <!-- Total -->        <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-transform">            <div class="flex items-center justify-between mb-3">                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>                    </svg>                </div>                <span class="text-4xl font-bold">18</span>            </div>            <h3 class="text-sm font-medium opacity-90">Tiempo Total Estimado</h3>            <p class="text-xs opacity-75">días hábiles (completo)</p>        </div>    </div>    <!-- Process Flow - Fase Actual y Roles -->    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">        <!-- Fase Actual -->        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">            <div class="p-6">                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>                    </svg>                    FASE 1: Inicio y Planificación (En Progreso)                </h3>                                <!-- Actividades de la Fase 1 según doc1.txt (líneas 27-55) -->                <div class="space-y-3">                    <!-- Actividad 1 -->                    <div class="flex items-start p-4 bg-green-50 rounded-lg border-l-4 border-green-500">                        <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>                        </svg>                        <div class="flex-1">                            <h4 class="font-medium text-green-900">Actividad 1: Registrar Plan de Implementación</h4>                            <p class="text-sm text-green-700 mt-1">Actor: Secretario CTPPGE • Tiempo: 1 día</p>                            <p class="text-xs text-green-600 mt-1">✓ Completado • Documento: Plan PGE vigente</p>                        </div>                    </div>                    <!-- Actividad 2 -->                    <div class="flex items-start p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">                        <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>                        </svg>                        <div class="flex-1">                            <h4 class="font-medium text-blue-900">Actividad 2: Solicitar conformación del Órgano Colegiado</h4>                            <p class="text-sm text-blue-700 mt-1">Actor: Secretario CTPPGE • Tiempo: 1 día</p>                            <p class="text-xs text-blue-600 mt-1">⏳ En progreso • Documento: Oficio de solicitud</p>                        </div>                    </div>                    <!-- Actividad 3 -->                    <div class="flex items-start p-4 bg-gray-50 rounded-lg border-l-4 border-gray-300">                        <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>                        </svg>                        <div class="flex-1">                            <h4 class="font-medium text-gray-600">Actividad 3: Recepcionar resolución de conformación</h4>                            <p class="text-sm text-gray-500 mt-1">Actor: Secretario CTPPGE • Tiempo: 1 día</p>                            <p class="text-xs text-gray-500 mt-1">○ Pendiente • Documento: Resolución de conformación</p>                        </div>                    </div>                    <!-- Actividad 4 -->                    <div class="flex items-start p-4 bg-gray-50 rounded-lg border-l-4 border-gray-300">                        <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>                        </svg>                        <div class="flex-1">                            <h4 class="font-medium text-gray-600">Actividad 4: Coordinar reunión de inicio</h4>                            <p class="text-sm text-gray-500 mt-1">Actor: Secretario CTPPGE • Tiempo: 1 hora</p>                            <p class="text-xs text-gray-500 mt-1">○ Pendiente • Documento: Invitación a reunión</p>                        </div>                    </div>                    <!-- Actividad 5 -->                    <div class="flex items-start p-4 bg-gray-50 rounded-lg border-l-4 border-gray-300">                        <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>                        </svg>                        <div class="flex-1">                            <h4 class="font-medium text-gray-600">Actividad 5: Aprobar Plan de Trabajo preliminar</h4>                            <p class="text-sm text-gray-500 mt-1">Actor: Órgano Colegiado • Tiempo: 3 días</p>                            <p class="text-xs text-gray-500 mt-1">○ Pendiente • Documento: Acta de aprobación</p>                        </div>                    </div>                </div>            </div>        </div>        <!-- Roles Involucrados según doc1.txt (líneas 6-19) -->        <div class="bg-white rounded-xl shadow-sm border border-gray-200">            <div class="p-6">                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">                    <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>                    </svg>                    Roles del Proceso                </h3>                                <div class="space-y-3">                    <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">                        <div class="flex items-center mb-1">                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>                            <h4 class="font-semibold text-blue-900 text-sm">Secretario CTPPGE</h4>                        </div>                        <p class="text-xs text-blue-700 ml-4">Coordinador general y gestor documental</p>                    </div>                    <div class="p-3 bg-purple-50 rounded-lg border border-purple-200">                        <div class="flex items-center mb-1">                            <span class="w-2 h-2 bg-purple-600 rounded-full mr-2"></span>                            <h4 class="font-semibold text-purple-900 text-sm">Órgano Colegiado</h4>                        </div>                        <p class="text-xs text-purple-700 ml-4">Aprobación de planes y actas</p>                    </div>                    <div class="p-3 bg-green-50 rounded-lg border border-green-200">                        <div class="flex items-center mb-1">                            <span class="w-2 h-2 bg-green-600 rounded-full mr-2"></span>                            <h4 class="font-semibold text-green-900 text-sm">Responsables de Componentes</h4>                        </div>                        <p class="text-xs text-green-700 ml-4">Ejecución de áreas específicas</p>                    </div>                    <div class="p-3 bg-orange-50 rounded-lg border border-orange-200">                        <div class="flex items-center mb-1">                            <span class="w-2 h-2 bg-orange-600 rounded-full mr-2"></span>                            <h4 class="font-semibold text-orange-900 text-sm">Procuraduría</h4>                        </div>                        <p class="text-xs text-orange-700 ml-4">Validación legal y observaciones</p>                    </div>                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">                        <div class="flex items-center mb-1">                            <span class="w-2 h-2 bg-gray-600 rounded-full mr-2"></span>                            <h4 class="font-semibold text-gray-900 text-sm">Entidad Receptora</h4>                        </div>                        <p class="text-xs text-gray-700 ml-4">Recibe funciones y activos</p>                    </div>                </div>            </div>        </div>    </div>    <!-- 5 Componentes de Ejecución según doc1.txt (líneas 56-99) -->    <div class="bg-white rounded-xl shadow-sm border border-gray-200">        <div class="p-6">            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>                </svg>                FASE 2: Ejecución por Componentes (5 días - Paralelo)            </h3>            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">                <!-- Componente 1: Presupuesto -->                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-md transition-shadow">                    <div class="flex items-center justify-between mb-3">                        <h4 class="font-semibold text-blue-900 text-sm">Presupuesto</h4>                        <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded-full">5d</span>                    </div>                    <p class="text-xs text-blue-700 mb-2">Responsable de Presupuesto</p>                    <ul class="text-xs text-blue-600 space-y-1">                        <li>• Levantamiento info</li>                        <li>• Validación anexos</li>                        <li>• BD seguimiento</li>                    </ul>                    <div class="mt-3 pt-3 border-t border-blue-200">                        <span class="text-xs text-blue-700 font-medium">📄 Anexo Presupuesto</span>                    </div>                </div>                <!-- Componente 2: Bienes y Servicios -->                <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:shadow-md transition-shadow">                    <div class="flex items-center justify-between mb-3">                        <h4 class="font-semibold text-green-900 text-sm">Bienes y Servicios</h4>                        <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded-full">5d</span>                    </div>                    <p class="text-xs text-green-700 mb-2">Responsable Bienes</p>                    <ul class="text-xs text-green-600 space-y-1">                        <li>• Inventario bienes</li>                        <li>• Validación conformidad</li>                        <li>• Acta de cierre</li>                    </ul>                    <div class="mt-3 pt-3 border-t border-green-200">                        <span class="text-xs text-green-700 font-medium">📄 Acta Cierre - Bienes</span>                    </div>                </div>                <!-- Componente 3: Acervo Documentario -->                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-md transition-shadow">                    <div class="flex items-center justify-between mb-3">                        <h4 class="font-semibold text-purple-900 text-sm">Acervo Documentario</h4>                        <span class="text-xs bg-purple-200 text-purple-800 px-2 py-1 rounded-full">5d</span>                    </div>                    <p class="text-xs text-purple-700 mb-2">Responsable Acervo</p>                    <ul class="text-xs text-purple-600 space-y-1">                        <li>• Custodia y digitalización</li>                        <li>• Registro carpeta</li>                        <li>• Actualización BD</li>                    </ul>                    <div class="mt-3 pt-3 border-t border-purple-200">                        <span class="text-xs text-purple-700 font-medium">📄 BD Acervo Digital</span>                    </div>                </div>                <!-- Componente 4: TI -->                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-lg border border-orange-200 hover:shadow-md transition-shadow">                    <div class="flex items-center justify-between mb-3">                        <h4 class="font-semibold text-orange-900 text-sm">Tecnología TI</h4>
                        <span class="text-xs bg-orange-200 text-orange-800 px-2 py-1 rounded-full">5d</span>
                    </div>
                    <p class="text-xs text-orange-700 mb-2">Responsable TI</p>
                    <ul class="text-xs text-orange-600 space-y-1">
                        <li>• Instalación sistemas</li>
                        <li>• Configuración</li>
                        <li>• Acta de cierre</li>
                    </ul>
                    <div class="mt-3 pt-3 border-t border-orange-200">
                        <span class="text-xs text-orange-700 font-medium">📄 Acta Cierre - TI</span>
                    </div>
                </div>

                <!-- Componente 5: RRHH -->
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-4 rounded-lg border border-pink-200 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-semibold text-pink-900 text-sm">Recursos Humanos</h4>
                        <span class="text-xs bg-pink-200 text-pink-800 px-2 py-1 rounded-full">5d</span>
                    </div>
                    <p class="text-xs text-pink-700 mb-2">Responsable RRHH</p>
                    <ul class="text-xs text-pink-600 space-y-1">
                        <li>• Levantamiento personal</li>
                        <li>• Validación nóminas</li>
                        <li>• Acta de cierre</li>
                    </ul>
                    <div class="mt-3 pt-3 border-t border-pink-200">
                        <span class="text-xs text-pink-700 font-medium">📄 Acta Cierre - RRHH</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fase 3: Validación y Cierre según doc1.txt (líneas 100-131) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                FASE 3: Validación y Cierre (6 días)
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Actividad 6 -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Act 6</span>
                        <span class="text-xs text-gray-600">3d</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Revisar y validar</h4>
                    <p class="text-xs text-gray-600 mb-2">Órgano Colegiado + Procuraduría</p>
                    <p class="text-xs text-gray-500">Observaciones y validación final</p>
                </div>

                <!-- Actividad 7 -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Act 7</span>
                        <span class="text-xs text-gray-600">2d</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Suscribir actas</h4>
                    <p class="text-xs text-gray-600 mb-2">Órgano Colegiado + Procuraduría</p>
                    <p class="text-xs text-gray-500">Actas firmadas de componentes</p>
                </div>

                <!-- Actividad 8 -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Act 8</span>
                        <span class="text-xs text-gray-600">1d</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Acta Final</h4>
                    <p class="text-xs text-gray-600 mb-2">Secretario CTPPGE</p>
                    <p class="text-xs text-gray-500">Consolidación del proceso</p>
                </div>

                <!-- Actividad 9 -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Act 9</span>
                        <span class="text-xs text-gray-600">3d</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Decreto Supremo</h4>
                    <p class="text-xs text-gray-600 mb-2">Procuraduría</p>
                    <p class="text-xs text-gray-500">Formalización legal</p>
                </div>

                <!-- Actividad 10 -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Act 10</span>
                        <span class="text-xs text-gray-600">1d</span>
                    </div>
                    <h4 class="font-semibold text-gray-900 text-sm mb-2">Publicación</h4>
                    <p class="text-xs text-gray-600 mb-2">Entidad Receptora</p>
                    <p class="text-xs text-gray-500">El Peruano (oficial)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Control de Calidad según doc1.txt (líneas 156-160) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl shadow-sm border border-indigo-200 p-6">
            <h3 class="text-lg font-semibold text-indigo-900 mb-4 flex items-center">
                <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Control de Calidad y Seguimiento
            </h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <div>
                        <p class="font-medium text-indigo-900 text-sm">Base de datos Excel compartida</p>
                        <p class="text-xs text-indigo-700">Actualización continua de avances</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <p class="font-medium text-indigo-900 text-sm">Reuniones semanales</p>
                        <p class="text-xs text-indigo-700">Programadas por el Secretario CTPPGE</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                    <div>
                        <p class="font-medium text-indigo-900 text-sm">Validación legal</p>
                        <p class="text-xs text-indigo-700">Por Procuraduría en etapas críticas</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <div>
                        <p class="font-medium text-indigo-900 text-sm">Auditoría interna</p>
                        <p class="text-xs text-indigo-700">Opcional, al final del proceso</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recomendaciones según doc1.txt (líneas 161-165) -->
        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl shadow-sm border border-amber-200 p-6">
            <h3 class="text-lg font-semibold text-amber-900 mb-4 flex items-center">
                <svg class="w-5 h-5 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                Recomendaciones Finales
            </h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <span class="w-6 h-6 bg-amber-200 text-amber-900 rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">1</span>
                    <div>
                        <p class="font-medium text-amber-900 text-sm">Clarificar roles en el SGD</p>
                        <p class="text-xs text-amber-700">Perfiles específicos para evitar confusiones</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <span class="w-6 h-6 bg-amber-200 text-amber-900 rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">2</span>
                    <div>
                        <p class="font-medium text-amber-900 text-sm">Automatizar notificaciones</p>
                        <p class="text-xs text-amber-700">Alertas en SGD para recordatorios de plazos</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <span class="w-6 h-6 bg-amber-200 text-amber-900 rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">3</span>
                    <div>
                        <p class="font-medium text-amber-900 text-sm">Estándarizar formatos</p>
                        <p class="text-xs text-amber-700">Plantillas únicas para oficios, actas y anexos</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <span class="w-6 h-6 bg-amber-200 text-amber-900 rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">4</span>
                    <div>
                        <p class="font-medium text-amber-900 text-sm">Incluir checklist</p>
                        <p class="text-xs text-amber-700">Verificar cumplimiento antes de siguiente fase</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Footer -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-lg mb-1">📋 Proceso de Transferencia PGE</h3>
                <p class="text-sm text-gray-300">Sistema de Gestión Documental (SGD) • Plan de Implementación vigente</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold">18 días</p>
                <p class="text-xs text-gray-400">Tiempo total estimado</p>
            </div>
        </div>
    </div>
</div>
@endsection

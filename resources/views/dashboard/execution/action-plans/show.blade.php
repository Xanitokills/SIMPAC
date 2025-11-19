@extends('layouts.dashboard')

@section('page-title', 'Detalle del Plan de Acción')
@section('page-description', $actionPlan->title)

@section('content')
<div class="space-y-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg text-white p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold">{{ $actionPlan->title }}</h1>
                    <p class="text-blue-100 mt-2">Plan de Acción Aprobado</p>
                    <p class="text-sm text-blue-200 mt-1">
                        Entidad: {{ $actionPlan->entityAssignment->entity->name }}
                    </p>
                    <p class="text-sm text-blue-200">
                        Sectorista: {{ $actionPlan->entityAssignment->sectorista->name }}
                    </p>
                </div>
                <div class="text-right space-y-2">
                    <div>
                        <span class="inline-block px-4 py-2 bg-white text-blue-700 rounded-lg font-semibold">
                            {{ $actionPlan->status === 'active' ? 'Activo' : 'Completado' }}
                        </span>
                    </div>
                    <div>
                        <a href="{{ route('execution.action-plans.manage', $actionPlan->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white text-blue-700 hover:bg-blue-50 rounded-lg font-semibold transition-colors shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Gestionar Plan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-blue-200">Fecha de Aprobación:</span>
                    <span class="font-semibold ml-2">{{ $actionPlan->approval_date->format('d/m/Y') }}</span>
                </div>
                @if($actionPlan->description)
                    <div class="col-span-2">
                        <span class="text-blue-200">Descripción:</span>
                        <p class="mt-1">{{ $actionPlan->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Acciones</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $actionPlan->items->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">En Proceso</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $actionPlan->items->whereIn('status', ['en_proceso', 'proceso'])->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-between">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Completadas</p>
                        <p class="text-2xl font-bold text-green-600">{{ $actionPlan->items->where('status', 'completado')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs de Visualización -->
        <div class="bg-white rounded-lg shadow">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px" aria-label="Tabs">
                    <button onclick="switchTab('components')" id="tab-components" 
                            class="tab-button active border-b-2 border-blue-500 text-blue-600 py-4 px-6 text-sm font-medium hover:text-blue-700 hover:border-blue-700 focus:outline-none">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        Vista por Componentes
                    </button>
                    <button onclick="switchTab('list')" id="tab-list" 
                            class="tab-button border-b-2 border-transparent text-gray-500 py-4 px-6 text-sm font-medium hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Vista Tipo Lista (JIRA)
                    </button>
                </nav>
            </div>

            <!-- Tab Content: Vista por Componentes -->
            <div id="content-components" class="tab-content">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Acciones del Plan por Sección</h2>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                    @if(!empty($groupedItems))
                        @foreach($groupedItems as $sectionKey => $items)
                            @php $idx = $loop->index; @endphp
                            <div class="bg-white rounded-lg border mb-2 overflow-hidden">
                                <div class="px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white cursor-pointer flex justify-between items-center" onclick="toggleShowSection('show-section-{{ $idx }}', 'show-icon-{{ $idx }}')">
                                    <div class="flex items-center space-x-3">
                                        <svg id="show-icon-{{ $idx }}" class="w-5 h-5 mr-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        <h4 class="font-semibold">{{ $sectionKey }}</h4>
                                    </div>
                                    <span class="bg-white text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">{{ count($items) }} {{ count($items) === 1 ? 'acción' : 'acciones' }}</span>
                                </div>

                                <div id="show-section-{{ $idx }}" style="display: none;" class="p-4">
                                    @foreach($items as $item)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow mb-3">
                                            <div class="flex justify-between items-start mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-3 mb-2">
                                                        @if($item->status === 'pendiente')
                                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Pendiente</span>
                                                        @elseif($item->status === 'en_proceso' || $item->status === 'proceso')
                                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">En Proceso</span>
                                                        @else
                                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
-                                                ✓ Finalizado
+                                                ✓ Completado
                                            </span>
                                                        @endif
                                                        @if($item->end_date)
                                                            <span class="text-sm text-gray-600">Vence: {{ $item->end_date->format('d/m/Y') }}</span>
                                                        @endif
                                                    </div>
                                                    <p class="text-gray-800 font-medium"><span class="text-xs text-gray-500">{{ $item->action_name }}</span> - {{ $item->description }}</p>
                                                    <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Responsable:</span> {{ $item->responsible }}</p>
                                                    @if($item->predecessor_action)
                                                        <p class="text-sm text-gray-600 mt-1"><span class="font-semibold">Acción Predecesora:</span> {{ $item->predecessor_action }}</p>
                                                    @endif
                                                    @if($item->start_date && $item->end_date)
                                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                                                            <span><span class="font-semibold">Inicio:</span> {{ $item->start_date->format('d/m/Y') }}</span>
                                                            <span><span class="font-semibold">Fin:</span> {{ $item->end_date->format('d/m/Y') }}</span>
                                                            @if($item->business_days)
                                                                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded">{{ $item->business_days }} días hábiles</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <button onclick="openEditModal(
                                                    {{ $item->id }},
                                                    '{{ $item->status }}',
                                                    `{{ $item->comments ?? '' }}`,
                                                    '{{ $item->predecessor_action ?? '' }}',
                                                    '{{ $item->start_date ? $item->start_date->format('Y-m-d') : '' }}',
                                                    '{{ $item->end_date ? $item->end_date->format('Y-m-d') : '' }}',
                                                    '{{ $item->business_days ?? '' }}',
                                                    `{{ $item->problems ?? '' }}`,
                                                    `{{ $item->corrective_measures ?? '' }}`
                                                )" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">Actualizar</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-8">No hay acciones registradas en este plan.</p>
                    @endif
                    </div> <!-- Cierre de div.space-y-4 -->
                </div> <!-- Cierre de div.p-6 -->
            </div> <!-- Cierre de content-components -->
            
            <!-- Tab Content: Vista Tipo Lista (JIRA) -->
            <div id="content-list" class="tab-content hidden">
                <!-- ⚠️ BANNER DE VERIFICACIÓN - ELIMINAR DESPUÉS -->
                <div class="bg-red-600 text-white text-center py-8 px-6">
                    <h1 class="text-4xl font-bold mb-2">🔥 NUEVA VERSIÓN CARGADA 🔥</h1>
                    <p class="text-xl">El tab "Vista Tipo Lista (JIRA)" está funcionando correctamente</p>
                    <p class="text-lg mt-2">Si ves esto, el problema estaba en el caché del navegador</p>
                </div>
                
                <!-- Encabezado del tab -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 px-6 py-4">
                    <h2 class="text-xl font-semibold text-blue-900 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Vista Tipo Lista (JIRA) - Todas las Acciones
                    </h2>
                    <p class="text-sm text-blue-700 mt-1">Vista completa de todas las acciones del plan con filtros y edición rápida</p>
                </div>
                
                <div class="p-6">
                <!-- Quick Stats para lista -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total</p>
                                <h4 class="text-2xl font-bold text-gray-800">{{ $totalItems ?? 0 }}</h4>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pendientes</p>
                                <h4 class="text-2xl font-bold text-yellow-600">{{ $pendingItems ?? 0 }}</h4>
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">En Proceso</p>
                                <h4 class="text-2xl font-bold text-blue-600">{{ $inProgressItems ?? 0 }}</h4>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Completados</p>
                                <h4 class="text-2xl font-bold text-green-600">{{ $completedItems ?? 0 }}</h4>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros y búsqueda -->
                <div class="bg-white rounded-lg shadow p-4 mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="searchListView" class="block text-sm font-medium text-gray-700 mb-2">
                                Buscar
                            </label>
                            <input type="text" id="searchListView" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Buscar por descripción o responsable...">
                        </div>
                        <div>
                            <label for="filterSectionListView" class="block text-sm font-medium text-gray-700 mb-2">
                                Sección
                            </label>
                            <select id="filterSectionListView" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Todas las secciones</option>
                                @if(isset($sections))
                                    @foreach($sections as $section)
                                        <option value="{{ $section }}">{{ $section }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="filterStatusListView" class="block text-sm font-medium text-gray-700 mb-2">
                                Estado
                            </label>
                            <select id="filterStatusListView" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Todos los estados</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en_proceso">En Proceso</option>
                                <option value="completado">Completado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="itemsTableListView">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">#</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-96">Descripción</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if(!isset($items) || $items->isEmpty())
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-lg font-medium mb-2">No hay items en este plan de acción</p>
                                            <p class="text-sm">{{ !isset($items) ? 'ERROR: Variable $items no existe' : 'Agrega items desde la vista de edición del plan.' }}</p>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($items as $item)
                                    <tr data-item-id="{{ $item->id }}" 
                                        data-section="{{ $item->section_name }}" 
                                        data-status="{{ $item->status }}"
                                        class="hover:bg-gray-50 transition-colors list-view-row">
                                        <!-- Order -->
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->order }}
                                        </td>
                                        
                                        <!-- Section -->
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                                {{ $item->section_name ?? 'Sin sección' }}
                                            </span>
                                        </td>
                                        
                                        <!-- Description -->
                                        <td class="px-4 py-3">
                                            <span class="text-sm text-gray-900">{{ $item->description }}</span>
                                        </td>
                                        
                                        <!-- Responsible -->
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span class="text-sm text-gray-900">{{ $item->responsible ?? 'Sin asignar' }}</span>
                                        </td>
                                        
                                        <!-- Status -->
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if($item->status === 'completado')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Completado
                                                </span>
                                            @elseif($item->status === 'en_proceso')
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    En Proceso
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pendiente
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <!-- End Date -->
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') : 'Sin fecha' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Link to full manage view -->
                <div class="mt-4 text-center">
                    <a href="{{ route('execution.action-plans.manage', $actionPlan->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Ir a Vista de Gestión Completa (con edición inline)
                    </a>
                    <p class="text-sm text-gray-500 mt-2">
                        La vista completa incluye edición inline, gestión de evidencias y más funciones.
                    </p>
                </div>
                </div> <!-- Cierre de div.p-6 -->
            </div> <!-- Cierre de content-list tab -->
        </div> <!-- Cierre del contenedor de tabs -->

        <!-- Botones de acción -->
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('execution.entity', $actionPlan->entityAssignment->id) }}" 
               class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                ← Volver al Panel de la Entidad
            </a>
            
            <button type="button" 
                    onclick="confirmDelete()" 
                    class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                🗑️ Eliminar Plan de Acción
            </button>
        </div>

        <!-- Formulario oculto para eliminación -->
        <form id="deleteForm" 
              action="{{ route('execution.action-plans.destroy', $actionPlan->id) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- Modal para editar acción -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Actualizar Acción</h3>
                
                <div class="space-y-4 max-h-[70vh] overflow-y-auto">
                    <!-- Acción Predecesora -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Acción Predecesora
                        </label>
                        <input type="text" 
                               name="predecessor_action" 
                               id="editPredecessor"
                               placeholder="Ejemplo: 1.1.1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Ingrese el código de la acción predecesora (opcional)</p>
                    </div>

                    <!-- Fechas -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Inicio
                            </label>
                            <input type="date" 
                                   name="start_date" 
                                   id="editStartDate"
                                   onchange="calculateBusinessDays()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Término
                            </label>
                            <input type="date" 
                                   name="end_date" 
                                   id="editEndDate"
                                   onchange="calculateBusinessDays()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Días hábiles (calculado automáticamente) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Días Hábiles (calculado automáticamente)
                        </label>
                        <input type="number" 
                               name="business_days" 
                               id="editBusinessDays"
                               readonly
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed">
                    </div>
                    
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                                id="editStatus"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="pendiente">PENDIENTE</option>
                            <option value="en_proceso">PROCESO</option>
                            <option value="completado">COMPLETADO</option>
                        </select>
                    </div>

                    <!-- Problemas Presentados -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Problemas Presentados
                        </label>
                        <textarea name="problems" 
                                  id="editProblems"
                                  rows="2"
                                  placeholder="Describa los problemas encontrados durante la ejecución..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Medidas Correctivas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Medidas Correctivas
                        </label>
                        <textarea name="corrective_measures" 
                                  id="editCorrectiveMeasures"
                                  rows="2"
                                  placeholder="Describa las medidas correctivas aplicadas..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <!-- Comentarios -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Comentarios
                        </label>
                        <textarea name="comments" 
                                  id="editComments"
                                  rows="2"
                                  placeholder="Comentarios adicionales..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <!-- Archivo Adjunto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Documentos de Sustento (PDF o Excel)
                        </label>
                        <input type="file" 
                               name="file"
                               accept=".pdf,.xls,.xlsx"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF, XLS, XLSX (Máx. 10MB)</p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                <button type="button" 
                        onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- cierre de space-y-6 -->

<script>
// Calcular días hábiles entre dos fechas (excluyendo sábados y domingos)
function calculateBusinessDays() {
    const startDate = document.getElementById('editStartDate').value;
    const endDate = document.getElementById('editEndDate').value;
    
    if (!startDate || !endDate) {
        document.getElementById('editBusinessDays').value = '';
        return;
    }
    
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    if (start > end) {
        alert('La fecha de inicio debe ser anterior a la fecha de término');
        document.getElementById('editBusinessDays').value = '';
        return;
    }
    
    let businessDays = 0;
    let currentDate = new Date(start);
    
    while (currentDate <= end) {
        const dayOfWeek = currentDate.getDay();
        // 0 = Domingo, 6 = Sábado
        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
            businessDays++;
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }
    
    document.getElementById('editBusinessDays').value = businessDays;
}

function openEditModal(itemId, status, comments, predecessor = '', startDate = '', endDate = '', businessDays = '', problems = '', correctiveMeasures = '') {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    form.action = `/dashboard/execution/action-plans/items/${itemId}`;
    document.getElementById('editStatus').value = status;
    document.getElementById('editComments').value = comments || '';
    document.getElementById('editPredecessor').value = predecessor || '';
    document.getElementById('editStartDate').value = startDate || '';
    document.getElementById('editEndDate').value = endDate || '';
    document.getElementById('editBusinessDays').value = businessDays || '';
    document.getElementById('editProblems').value = problems || '';
    document.getElementById('editCorrectiveMeasures').value = correctiveMeasures || '';
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Cerrar modal al hacer clic fuera
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Confirmar eliminación del plan de acción
function confirmDelete() {
    if (confirm('⚠️ ¿Está seguro de que desea eliminar este plan de acción?\n\nSe eliminarán:\n- Todas las acciones del plan\n- Todos los archivos adjuntos\n- Todo el historial de cambios\n\nEsta acción NO se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}

// Mostrar/Ocultar sección
function toggleShowSection(sectionId, iconId) {
    const section = document.getElementById(sectionId);
    const icon = document.getElementById(iconId);
    if (!section) return;
    if (section.style.display === 'none' || section.style.display === '') {
        section.style.display = 'block';
        if (icon) icon.classList.add('rotate-90');
    } else {
        section.style.display = 'none';
        if (icon) icon.classList.remove('rotate-90');
    }
}

// ==================== TAB SWITCHING ====================
function switchTab(tabName) {
    console.log('🔥 NUEVA VERSIÓN - Switching to tab:', tabName);
    
    // Ocultar todos los contenidos de tabs
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        console.log('❌ Hiding:', content.id);
    });
    
    // Remover clase active de todos los botones de tab
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Mostrar el contenido del tab seleccionado
    const selectedContent = document.getElementById(`content-${tabName}`);
    console.log('📍 Selected content element:', selectedContent);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
        // FORZAR visualización con estilo directo
        selectedContent.style.display = 'block';
        selectedContent.style.visibility = 'visible';
        selectedContent.style.opacity = '1';
        console.log('✅ SHOWING TAB:', tabName, 'Classes:', selectedContent.className);
        console.log('✅ Content visible:', !selectedContent.classList.contains('hidden'));
        console.log('✅ Display style:', selectedContent.style.display);
    } else {
        console.error('❌ NO SE ENCONTRÓ EL ELEMENTO:', `content-${tabName}`);
    }
    
    // Activar el botón del tab seleccionado
    const selectedButton = document.getElementById(`tab-${tabName}`);
    if (selectedButton) {
        selectedButton.classList.add('active', 'border-blue-500', 'text-blue-600');
        selectedButton.classList.remove('border-transparent', 'text-gray-500');
    }
    
    // Guardar tab activo en localStorage
    localStorage.setItem('activeActionPlanTab', tabName);
    
    // Scroll agresivo al top de la página y al contenido del tab
    window.scrollTo({ top: 0, behavior: 'instant' });
    
    // Dar tiempo al navegador para renderizar y luego hacer scroll al contenido
    setTimeout(() => {
        if (selectedContent) {
            selectedContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }, 50);
}

// Restaurar tab activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const activeTab = localStorage.getItem('activeActionPlanTab') || 'components';
    switchTab(activeTab);
    
    // ==================== FILTROS PARA VISTA TIPO LISTA ====================
    const searchInputListView = document.getElementById('searchListView');
    const sectionFilterListView = document.getElementById('filterSectionListView');
    const statusFilterListView = document.getElementById('filterStatusListView');
    
    function applyListViewFilters() {
        const searchTerm = searchInputListView ? searchInputListView.value.toLowerCase() : '';
        const sectionFilter = sectionFilterListView ? sectionFilterListView.value : '';
        const statusFilter = statusFilterListView ? statusFilterListView.value : '';
        
        const rows = document.querySelectorAll('.list-view-row');
        
        rows.forEach(row => {
            const description = row.querySelector('td:nth-child(3)') ? row.querySelector('td:nth-child(3)').textContent.toLowerCase() : '';
            const responsible = row.querySelector('td:nth-child(4)') ? row.querySelector('td:nth-child(4)').textContent.toLowerCase() : '';
            const section = row.dataset.section || '';
            const status = row.dataset.status || '';
            
            const matchesSearch = !searchTerm || description.includes(searchTerm) || responsible.includes(searchTerm);
            const matchesSection = !sectionFilter || section === sectionFilter;
            const matchesStatus = !statusFilter || status === statusFilter;
            
            if (matchesSearch && matchesSection && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    if (searchInputListView) {
        searchInputListView.addEventListener('input', applyListViewFilters);
    }
    if (sectionFilterListView) {
        sectionFilterListView.addEventListener('change', applyListViewFilters);
    }
    if (statusFilterListView) {
        statusFilterListView.addEventListener('change', applyListViewFilters);
    }
});
</script>

<style>
.tab-button {
    transition: all 0.3s ease;
}

.tab-button.active {
    font-weight: 600;
}

.tab-content {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* FORZAR VISUALIZACIÓN DE TABS */
.tab-content {
    display: none !important;
}

.tab-content:not(.hidden) {
    display: block !important;
}
</style>
@endsection

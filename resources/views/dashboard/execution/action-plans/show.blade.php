@extends('layouts.dashboard')

@section('page-title', 'Detalle del Plan de Acción')
@section('page-description', $actionPlan->title)

@section('content')
<div class="space-y-6">
    <div id="mainContainer" class="max-w-6xl mx-auto transition-all duration-300">
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
            
            <!-- Tab Content: Vista Tipo Lista (JIRA) - MODO GESTIÓN COMPLETO -->
            <div id="content-list" class="tab-content hidden">
                <!-- Header con botón guardar -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Vista Tipo Lista (JIRA) - Gestión Completa
                        </h2>
                        <p class="text-blue-100 text-sm mt-1">Haz clic en cualquier celda para editar • Los cambios se guardan automáticamente</p>
                    </div>
                    <button type="button" id="saveAllChangesBtn" 
                            class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold transition-colors shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
                
                <div class="p-6">
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
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
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
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
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-400">
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
                        <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
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
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Buscar
                                </label>
                                <input type="text" id="searchListView" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Buscar por descripción o responsable...">
                            </div>
                            <div>
                                <label for="filterSectionListView" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
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
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
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

                    <!-- Items Table con edición inline -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto overflow-y-auto" style="max-height: calc(100vh - 350px); min-height: 400px;">
                            <table class="min-w-full divide-y divide-gray-200" id="itemsTableListView">
                                <thead class="bg-gray-50 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">#</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-96">Descripción</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsable</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencia</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if(!isset($items) || $items->isEmpty())
                                        <tr>
                                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <p class="text-lg font-medium mb-2">No hay items en este plan de acción</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($items as $item)
                                        <tr data-item-id="{{ $item->id }}" 
                                            data-section="{{ $item->section_name }}" 
                                            data-status="{{ $item->status }}"
                                            class="hover:bg-blue-50 transition-colors list-view-row">
                                            <!-- Order -->
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-medium">
                                                {{ $item->order }}
                                            </td>
                                            
                                            <!-- Section (Editable) -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="editable-cell" data-field="section_name">
                                                    <div class="view-mode flex items-center group cursor-pointer">
                                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 section-badge">
                                                            {{ $item->section_name ?? 'Sin sección' }}
                                                        </span>
                                                        <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="edit-mode hidden">
                                                        <input type="text" value="{{ $item->section_name }}" 
                                                               class="w-full px-2 py-1 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                        <div class="flex gap-1 mt-1">
                                                            <button class="save-edit px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">✓</button>
                                                            <button class="cancel-edit px-2 py-1 text-xs bg-gray-300 text-gray-700 rounded hover:bg-gray-400">✗</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Description (Editable) -->
                                            <td class="px-4 py-3">
                                                <div class="editable-cell" data-field="description">
                                                    <div class="view-mode group flex items-start cursor-pointer">
                                                        <span class="description-text text-sm text-gray-900 flex-1">{{ $item->description }}</span>
                                                        <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity edit-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="edit-mode hidden">
                                                        <textarea class="w-full px-2 py-1 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3">{{ $item->description }}</textarea>
                                                        <div class="flex gap-1 mt-1">
                                                            <button class="save-edit px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
                                                            <button class="cancel-edit px-2 py-1 text-xs bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Responsible (Editable) -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="editable-cell" data-field="responsible">
                                                    <div class="view-mode flex items-center group cursor-pointer">
                                                        <span class="responsible-text text-sm text-gray-900">{{ $item->responsible ?? 'Sin asignar' }}</span>
                                                        <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="edit-mode hidden">
                                                        <input type="text" value="{{ $item->responsible }}" 
                                                               class="w-full px-2 py-1 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                        <div class="flex gap-1 mt-1">
                                                            <button class="save-edit px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">✓</button>
                                                            <button class="cancel-edit px-2 py-1 text-xs bg-gray-300 text-gray-700 rounded hover:bg-gray-400">✗</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Status (Editable) -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="editable-cell" data-field="status">
                                                    <div class="view-mode flex items-center group cursor-pointer">
                                                        @php
                                                            $statusColors = [
                                                                'pendiente' => 'bg-yellow-100 text-yellow-800',
                                                                'en_proceso' => 'bg-blue-100 text-blue-800',
                                                                'completado' => 'bg-green-100 text-green-800'
                                                            ];
                                                            $statusLabels = [
                                                                'pendiente' => 'Pendiente',
                                                                'en_proceso' => 'En Proceso',
                                                                'completado' => 'Completado'
                                                            ];
                                                        @endphp
                                                        <span class="px-2 py-1 text-xs font-medium rounded-full status-badge {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                            {{ $statusLabels[$item->status] ?? $item->status }}
                                                        </span>
                                                        <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="edit-mode hidden">
                                                        <select class="w-full px-2 py-1 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                            <option value="pendiente" {{ $item->status === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                            <option value="en_proceso" {{ $item->status === 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                                            <option value="completado" {{ $item->status === 'completado' ? 'selected' : '' }}>Completado</option>
                                                        </select>
                                                        <div class="flex gap-1 mt-1">
                                                            <button class="save-edit px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">✓</button>
                                                            <button class="cancel-edit px-2 py-1 text-xs bg-gray-300 text-gray-700 rounded hover:bg-gray-400">✗</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Due Date (Editable) -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <div class="editable-cell" data-field="end_date">
                                                    <div class="view-mode flex items-center group cursor-pointer">
                                                        <span class="due-date-text text-sm {{ $item->end_date ? 'text-gray-900' : 'text-gray-400' }}">
                                                            {{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') : 'Sin fecha' }}
                                                        </span>
                                                        <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="edit-mode hidden">
                                                        <input type="date" value="{{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('Y-m-d') : '' }}" 
                                                               class="w-full px-2 py-1 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                        <div class="flex gap-1 mt-1">
                                                            <button class="save-edit px-2 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700">✓</button>
                                                            <button class="cancel-edit px-2 py-1 text-xs bg-gray-300 text-gray-700 rounded hover:bg-gray-400">✗</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Evidence -->
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                @if($item->evidence_file)
                                                    <div class="flex items-center gap-2">
                                                        <a href="{{ route('execution.action-plans.items.download-file', $item->id) }}" 
                                                           class="inline-flex items-center px-2 py-1 text-xs text-blue-600 hover:text-blue-800 transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                            </svg>
                                                            Ver
                                                        </a>
                                                        <button type="button" data-item-id="{{ $item->id }}" 
                                                                class="delete-file-btn inline-flex items-center px-2 py-1 text-xs text-red-600 hover:text-red-800 transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @else
                                                    <button type="button" data-item-id="{{ $item->id }}" 
                                                            class="upload-file-btn inline-flex items-center px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                        </svg>
                                                        Subir
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    console.log('Switching to tab:', tabName);
    
    // Ocultar todos los contenidos de tabs
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
        content.style.display = 'none';
    });
    
    // Remover clase active de todos los botones de tab
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Mostrar el contenido del tab seleccionado
    const selectedContent = document.getElementById(`content-${tabName}`);
    if (selectedContent) {
        selectedContent.classList.remove('hidden');
        selectedContent.style.display = 'block';
    }
    
    // Activar el botón del tab seleccionado
    const selectedButton = document.getElementById(`tab-${tabName}`);
    if (selectedButton) {
        selectedButton.classList.add('active', 'border-blue-500', 'text-blue-600');
        selectedButton.classList.remove('border-transparent', 'text-gray-500');
    }
    
    // *** EXPANDIR/CONTRAER LAYOUT SEGÚN EL TAB ***
    const mainContainer = document.getElementById('mainContainer');
    if (mainContainer) {
        if (tabName === 'list') {
            // Vista JIRA: expandir a tamaño completo
            mainContainer.classList.remove('max-w-6xl');
            mainContainer.classList.add('max-w-full', 'px-4');
        } else {
            // Vista por componentes: mantener ancho limitado
            mainContainer.classList.add('max-w-6xl');
            mainContainer.classList.remove('max-w-full', 'px-4');
        }
    }
    
    // Guardar tab activo en localStorage
    localStorage.setItem('activeActionPlanTab', tabName);
    
    // Scroll al top
    window.scrollTo({ top: 0, behavior: 'instant' });
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
            const description = row.querySelector('.description-text') ? row.querySelector('.description-text').textContent.toLowerCase() : '';
            const responsible = row.querySelector('.responsible-text') ? row.querySelector('.responsible-text').textContent.toLowerCase() : '';
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
    
    // ==================== INLINE EDITING PARA VISTA TIPO LISTA ====================
    const changedItems = new Map();
    
    // Hacer clic en el icono de edición para entrar en modo edición
    document.querySelectorAll('#content-list .edit-icon').forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.stopPropagation();
            const cell = this.closest('.editable-cell');
            enterEditMode(cell);
        });
    });
    
    // Hacer clic en la celda para entrar en modo edición
    document.querySelectorAll('#content-list .editable-cell .view-mode').forEach(viewMode => {
        viewMode.addEventListener('click', function(e) {
            if (!e.target.classList.contains('edit-icon')) {
                const cell = this.closest('.editable-cell');
                enterEditMode(cell);
            }
        });
    });
    
    function enterEditMode(cell) {
        const viewMode = cell.querySelector('.view-mode');
        const editMode = cell.querySelector('.edit-mode');
        
        viewMode.classList.add('hidden');
        editMode.classList.remove('hidden');
        
        const input = editMode.querySelector('input, textarea, select');
        if (input) {
            input.focus();
            if (input.tagName === 'TEXTAREA' || input.type === 'text') {
                input.select();
            }
        }
        
        cell.closest('tr').classList.add('editing');
    }
    
    function exitEditMode(cell, save = false) {
        const viewMode = cell.querySelector('.view-mode');
        const editMode = cell.querySelector('.edit-mode');
        const row = cell.closest('tr');
        const itemId = row.dataset.itemId;
        const field = cell.dataset.field;
        
        if (save) {
            const input = editMode.querySelector('input, textarea, select');
            const newValue = input.value.trim();
            const oldValue = getViewModeValue(cell);
            
            if (newValue !== oldValue) {
                updateViewMode(cell, newValue);
                
                if (!changedItems.has(itemId)) {
                    changedItems.set(itemId, {});
                }
                changedItems.get(itemId)[field] = newValue;
                
                row.classList.add('changed');
                row.dataset[field] = newValue; // Actualizar data attribute para filtros
                showNotification('Campo actualizado. Haz clic en "Guardar Cambios" para confirmar.', 'info');
            }
        }
        
        editMode.classList.add('hidden');
        viewMode.classList.remove('hidden');
        row.classList.remove('editing');
    }
    
    function getViewModeValue(cell) {
        const field = cell.dataset.field;
        const viewMode = cell.querySelector('.view-mode');
        
        switch(field) {
            case 'description':
                return viewMode.querySelector('.description-text')?.textContent.trim() || '';
            case 'responsible':
                return viewMode.querySelector('.responsible-text')?.textContent.trim() || '';
            case 'section_name':
                return viewMode.querySelector('.section-badge')?.textContent.trim() || '';
            case 'status':
                const select = cell.querySelector('.edit-mode select');
                return select?.value || '';
            case 'end_date':
                const input = cell.querySelector('.edit-mode input[type="date"]');
                return input?.value || '';
            default:
                return '';
        }
    }
    
    function updateViewMode(cell, newValue) {
        const field = cell.dataset.field;
        const viewMode = cell.querySelector('.view-mode');
        
        switch(field) {
            case 'description':
                viewMode.querySelector('.description-text').textContent = newValue;
                break;
            case 'responsible':
                viewMode.querySelector('.responsible-text').textContent = newValue || 'Sin asignar';
                break;
            case 'section_name':
                viewMode.querySelector('.section-badge').textContent = newValue || 'Sin sección';
                break;
            case 'status':
                const statusLabels = {
                    'pendiente': 'Pendiente',
                    'en_proceso': 'En Proceso',
                    'completado': 'Completado'
                };
                const statusClasses = {
                    'pendiente': 'bg-yellow-100 text-yellow-800',
                    'en_proceso': 'bg-blue-100 text-blue-800',
                    'completado': 'bg-green-100 text-green-800'
                };
                const badge = viewMode.querySelector('.status-badge');
                badge.textContent = statusLabels[newValue] || newValue;
                badge.className = `px-2 py-1 text-xs font-medium rounded-full status-badge ${statusClasses[newValue] || 'bg-gray-100 text-gray-800'}`;
                break;
            case 'end_date':
                const dateText = viewMode.querySelector('.due-date-text');
                if (newValue) {
                    const date = new Date(newValue);
                    const formatted = date.toLocaleDateString('es-ES');
                    dateText.textContent = formatted;
                    dateText.classList.remove('text-gray-400');
                    dateText.classList.add('text-gray-900');
                } else {
                    dateText.textContent = 'Sin fecha';
                    dateText.classList.add('text-gray-400');
                    dateText.classList.remove('text-gray-900');
                }
                break;
        }
    }
    
    // Botones de guardar/cancelar en edición inline
    document.querySelectorAll('#content-list .save-edit').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, true);
        });
    });
    
    document.querySelectorAll('#content-list .cancel-edit').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, false);
        });
    });
    
    // Teclas para guardar/cancelar
    document.querySelectorAll('#content-list .edit-mode input, #content-list .edit-mode textarea').forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const cell = this.closest('.editable-cell');
                exitEditMode(cell, false);
            } else if (e.key === 'Enter' && input.tagName !== 'TEXTAREA') {
                e.preventDefault();
                const cell = this.closest('.editable-cell');
                exitEditMode(cell, true);
            }
        });
    });
    
    // ==================== SAVE ALL CHANGES ====================
    const saveAllBtn = document.getElementById('saveAllChangesBtn');
    if (saveAllBtn) {
        saveAllBtn.addEventListener('click', async function() {
            if (changedItems.size === 0) {
                showNotification('No hay cambios pendientes para guardar.', 'info');
                return;
            }
            
            const btn = this;
            const originalHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path></svg> Guardando...';
            
            let successCount = 0;
            let errorCount = 0;
            
            for (const [itemId, changes] of changedItems.entries()) {
                try {
                    const response = await fetch(`/dashboard/execution/action-plans/items/${itemId}`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(changes)
                    });
                    
                    if (response.ok) {
                        successCount++;
                        const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
                        if (row) row.classList.remove('changed');
                    } else {
                        errorCount++;
                        console.error(`Error updating item ${itemId}:`, await response.text());
                    }
                } catch (error) {
                    errorCount++;
                    console.error(`Error updating item ${itemId}:`, error);
                }
            }
            
            changedItems.clear();
            
            btn.disabled = false;
            btn.innerHTML = originalHTML;
            
            if (errorCount === 0) {
                showNotification(`✅ ${successCount} item(s) actualizado(s) exitosamente.`, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(`${successCount} item(s) actualizado(s), ${errorCount} error(es).`, 'warning');
            }
        });
    }
    
    // ==================== FILE UPLOAD ====================
    // Crear input de archivo oculto si no existe
    let fileInput = document.getElementById('fileInputListView');
    if (!fileInput) {
        fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.id = 'fileInputListView';
        fileInput.className = 'hidden';
        fileInput.accept = '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png';
        document.body.appendChild(fileInput);
    }
    
    let currentUploadItemId = null;
    
    document.querySelectorAll('#content-list .upload-file-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentUploadItemId = this.dataset.itemId;
            fileInput.click();
        });
    });
    
    fileInput.addEventListener('change', async function() {
        if (!this.files.length || !currentUploadItemId) return;
        
        const formData = new FormData();
        formData.append('evidence_file', this.files[0]);
        
        showNotification('Subiendo archivo...', 'info');
        
        try {
            const response = await fetch(`/dashboard/execution/action-plans/items/${currentUploadItemId}/upload-file`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (response.ok) {
                showNotification('✅ Archivo subido exitosamente.', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                const errorData = await response.json();
                showNotification('❌ Error al subir el archivo: ' + (errorData.message || 'Error desconocido'), 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('❌ Error al subir el archivo.', 'error');
        }
        
        this.value = '';
        currentUploadItemId = null;
    });
    
    // ==================== FILE DELETE ====================
    document.querySelectorAll('#content-list .delete-file-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('¿Estás seguro de eliminar este archivo?')) return;
            
            const itemId = this.dataset.itemId;
            
            try {
                const response = await fetch(`/dashboard/execution/action-plans/items/${itemId}/file`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    showNotification('✅ Archivo eliminado exitosamente.', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification('❌ Error al eliminar el archivo.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('❌ Error al eliminar el archivo.', 'error');
            }
        });
    });
    
    // ==================== HELPER: NOTIFICATION ====================
    function showNotification(message, type = 'info') {
        const colors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'warning': 'bg-yellow-500',
            'info': 'bg-blue-500'
        };
        
        // Remover notificaciones anteriores
        document.querySelectorAll('.toast-notification').forEach(t => t.remove());
        
        const toast = document.createElement('div');
        toast.className = `toast-notification fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity flex items-center`;
        toast.innerHTML = `<span>${message}</span>`;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3500);
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

/* Estilos para edición inline */
#content-list tr.editing {
    background-color: #eff6ff !important;
}

#content-list tr.changed {
    background-color: #fef3c7 !important;
}

#content-list .edit-mode input,
#content-list .edit-mode textarea,
#content-list .edit-mode select {
    font-size: 0.875rem;
}

/* Sticky header en tabla */
#itemsTableListView thead {
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Toast notification */
.toast-notification {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>
@endsection

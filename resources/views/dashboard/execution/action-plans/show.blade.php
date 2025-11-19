@extends('layouts.dashboard')

@section('page-title', 'Detalle del Plan de Acción')
@section('page-description', $actionPlan->title)

@section('content')
<div class="space-y-6">
    <div id="mainContainer" class="w-full px-4 transition-all duration-300">
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
                    <button onclick="switchTab('kanban')" id="tab-kanban" 
                            class="tab-button border-b-2 border-transparent text-gray-500 py-4 px-6 text-sm font-medium hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                        </svg>
                        Vista Kanban
                    </button>
                    <button onclick="switchTab('calendar')" id="tab-calendar" 
                            class="tab-button border-b-2 border-transparent text-gray-500 py-4 px-6 text-sm font-medium hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Calendario
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
                        @foreach($groupedItems as $sectionKey => $sectionItems)
                            @php $idx = $loop->index; @endphp
                            <div class="bg-white rounded-lg border mb-2 overflow-hidden">
                                <div class="px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white cursor-pointer flex justify-between items-center" onclick="toggleShowSection('show-section-{{ $idx }}', 'show-icon-{{ $idx }}')">
                                    <div class="flex items-center space-x-3">
                                        <svg id="show-icon-{{ $idx }}" class="w-5 h-5 mr-2 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                        <h4 class="font-semibold">{{ $sectionKey }}</h4>
                                    </div>
                                    <span class="bg-white text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">{{ count($sectionItems) }} {{ count($sectionItems) === 1 ? 'acción' : 'acciones' }}</span>
                                </div>

                                <div id="show-section-{{ $idx }}" style="display: none;" class="p-4">
                                    @foreach($sectionItems as $item)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow mb-3">
                                            <div class="flex justify-between items-start mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-3 mb-2">
                                                        @if($item->status === 'pendiente')
                                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">Pendiente</span>
                                                        @elseif($item->status === 'en_proceso' || $item->status === 'proceso')
                                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">En Proceso</span>
                                                        @else
                                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">✓ Completado</span>
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
                    <!-- Filtros y búsqueda -->
                    <div class="bg-white rounded-lg shadow p-4 mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                            <div>
                                <label for="itemsPerPage" class="block text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                    </svg>
                                    Items por página
                                </label>
                                <select id="itemsPerPage" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="10">10</option>
                                    <option value="25" selected>25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="all">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table con edición inline y ordenamiento -->
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="overflow-x-auto overflow-y-auto" style="max-height: calc(100vh - 380px); min-height: 400px;">
                            <table class="min-w-full divide-y divide-gray-200" id="itemsTableListView">
                                <thead class="bg-gray-50 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16 sortable-header cursor-pointer hover:bg-gray-100" data-sort="order">
                                            <div class="flex items-center">
                                                #
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sortable-header cursor-pointer hover:bg-gray-100" data-sort="section">
                                            <div class="flex items-center">
                                                Sección
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-96 sortable-header cursor-pointer hover:bg-gray-100" data-sort="description">
                                            <div class="flex items-center">
                                                Descripción
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sortable-header cursor-pointer hover:bg-gray-100" data-sort="responsible">
                                            <div class="flex items-center">
                                                Responsable
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sortable-header cursor-pointer hover:bg-gray-100" data-sort="status">
                                            <div class="flex items-center">
                                                Estado
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sortable-header cursor-pointer hover:bg-gray-100" data-sort="date">
                                            <div class="flex items-center">
                                                Fecha Límite
                                                <svg class="w-4 h-4 ml-1 sort-icon text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencia</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
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
                                            data-order="{{ $item->order }}"
                                            data-section="{{ $item->section_name }}" 
                                            data-description="{{ Str::lower($item->description) }}"
                                            data-responsible="{{ Str::lower($item->responsible ?? '') }}"
                                            data-status="{{ $item->status }}"
                                            data-date="{{ $item->end_date ? \Carbon\Carbon::parse($item->end_date)->format('Y-m-d') : '9999-99-99' }}"
                                            class="hover:bg-blue-50 transition-colors list-view-row">
                                            <!-- Order -->
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-medium order-cell">
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
                        
                        <!-- Paginación -->
                        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-3">
                            <div class="text-sm text-gray-700">
                                Mostrando <span id="showingFrom" class="font-medium">1</span> a <span id="showingTo" class="font-medium">25</span> de <span id="totalFiltered" class="font-medium">{{ $totalItems ?? 0 }}</span> items
                                <span id="filteredText" class="text-gray-500"></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <button id="prevPageBtn" class="px-3 py-1 text-sm bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    ← Anterior
                                </button>
                                <span class="text-sm text-gray-600">
                                    Página <span id="currentPage" class="font-medium">1</span> de <span id="totalPages" class="font-medium">1</span>
                                </span>
                                <button id="nextPageBtn" class="px-3 py-1 text-sm bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Siguiente →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Cierre de content-list tab -->

            <!-- Tab Content: Vista Kanban -->
            <div id="content-kanban" class="tab-content hidden">
                <!-- Header del Kanban -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                                </svg>
                                Vista Kanban - Organización por Estado
                            </h2>
                            <p class="text-purple-100 text-sm mt-1">Visualiza y organiza las acciones por su estado actual</p>
                        </div>
                        <!-- Filtro por Sección -->
                        <div class="flex items-center space-x-3">
                            <label class="text-sm text-purple-100">Filtrar por sección:</label>
                            <select id="kanbanSectionFilter" onchange="filterKanbanBySection(this.value)" class="px-3 py-2 border border-purple-400 bg-purple-500 text-white rounded-lg focus:ring-2 focus:ring-purple-300 text-sm">
                                <option value="">Todas las secciones ({{ $actionPlan->items->count() }})</option>
                                @foreach($groupedItems as $sectionKey => $sectionItems)
                                    <option value="{{ $sectionKey }}">{{ $sectionKey }} ({{ count($sectionItems) }} items)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tablero Kanban -->
                <div class="p-6 bg-gray-50 min-h-[600px]">
                    <div class="grid grid-cols-3 gap-6 h-full">
                        <!-- Columna: Pendiente -->
                        <div class="bg-gray-100 rounded-lg flex flex-col">
                            <div class="bg-gray-600 text-white px-4 py-3 rounded-t-lg flex justify-between items-center">
                                <h3 class="font-semibold flex items-center">
                                    <span class="w-3 h-3 bg-gray-300 rounded-full mr-2"></span>
                                    Pendiente
                                </h3>
                                <span id="kanban-count-pendiente" class="bg-gray-500 px-2 py-1 rounded-full text-sm font-bold">
                                    {{ $actionPlan->items->where('status', 'pendiente')->count() }}
                                </span>
                            </div>
                            <div id="kanban-column-pendiente" class="flex-1 p-3 space-y-3 overflow-y-auto max-h-[500px] min-h-[400px]">
                                @foreach($actionPlan->items->where('status', 'pendiente') as $item)
                                    @include('dashboard.execution.action-plans._kanban-card', ['item' => $item])
                                @endforeach
                            </div>
                        </div>

                        <!-- Columna: En Proceso -->
                        <div class="bg-yellow-50 rounded-lg flex flex-col">
                            <div class="bg-yellow-500 text-white px-4 py-3 rounded-t-lg flex justify-between items-center">
                                <h3 class="font-semibold flex items-center">
                                    <span class="w-3 h-3 bg-yellow-300 rounded-full mr-2"></span>
                                    En Proceso
                                </h3>
                                <span id="kanban-count-proceso" class="bg-yellow-400 px-2 py-1 rounded-full text-sm font-bold">
                                    {{ $actionPlan->items->whereIn('status', ['en_proceso', 'proceso'])->count() }}
                                </span>
                            </div>
                            <div id="kanban-column-proceso" class="flex-1 p-3 space-y-3 overflow-y-auto max-h-[500px] min-h-[400px]">
                                @foreach($actionPlan->items->whereIn('status', ['en_proceso', 'proceso']) as $item)
                                    @include('dashboard.execution.action-plans._kanban-card', ['item' => $item])
                                @endforeach
                            </div>
                        </div>

                        <!-- Columna: Completado -->
                        <div class="bg-green-50 rounded-lg flex flex-col">
                            <div class="bg-green-600 text-white px-4 py-3 rounded-t-lg flex justify-between items-center">
                                <h3 class="font-semibold flex items-center">
                                    <span class="w-3 h-3 bg-green-300 rounded-full mr-2"></span>
                                    Completado
                                </h3>
                                <span id="kanban-count-completado" class="bg-green-500 px-2 py-1 rounded-full text-sm font-bold">
                                    {{ $actionPlan->items->where('status', 'completado')->count() }}
                                </span>
                            </div>
                            <div id="kanban-column-completado" class="flex-1 p-3 space-y-3 overflow-y-auto max-h-[500px] min-h-[400px]">
                                @foreach($actionPlan->items->where('status', 'completado') as $item)
                                    @include('dashboard.execution.action-plans._kanban-card', ['item' => $item])
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Leyenda -->
                    <div class="mt-6 flex justify-center space-x-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-gray-400 rounded mr-2"></span>
                            Pendiente: Acciones sin iniciar
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-yellow-400 rounded mr-2"></span>
                            En Proceso: Acciones en ejecución
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-green-500 rounded mr-2"></span>
                            Completado: Acciones finalizadas
                        </div>
                    </div>
                </div>
            </div> <!-- Cierre de content-kanban tab -->

            <!-- Tab Content: Vista Calendario -->
            <div id="content-calendar" class="tab-content hidden">
                <!-- Header del Calendario -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Vista Calendario - Organización por Fechas
                            </h2>
                            <p class="text-indigo-100 text-sm mt-1">Visualiza las acciones organizadas por fecha de vencimiento</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button onclick="changeCalendarMonth(-1)" class="px-3 py-2 bg-indigo-500 hover:bg-indigo-400 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <span id="currentMonthYear" class="text-lg font-semibold min-w-[150px] text-center"></span>
                            <button onclick="changeCalendarMonth(1)" class="px-3 py-2 bg-indigo-500 hover:bg-indigo-400 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <button onclick="goToToday()" class="px-4 py-2 bg-white text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors ml-2">
                                Hoy
                            </button>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50">
                    <!-- Días de la semana -->
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Dom</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Lun</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Mar</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Mié</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Jue</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Vie</div>
                        <div class="text-center text-sm font-semibold text-gray-600 py-2">Sáb</div>
                    </div>

                    <!-- Grid del calendario -->
                    <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                        <!-- Los días se generarán con JavaScript -->
                    </div>

                    <!-- Leyenda del calendario -->
                    <div class="mt-6 flex justify-center space-x-6 text-sm text-gray-600">
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-gray-300 rounded mr-2"></span>
                            Pendiente
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-yellow-400 rounded mr-2"></span>
                            En Proceso
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-green-500 rounded mr-2"></span>
                            Completado
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-red-500 rounded mr-2"></span>
                            Vencido
                        </div>
                    </div>

                    <!-- Lista de acciones del día seleccionado -->
                    <div id="selectedDayActions" class="mt-6 hidden">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                            <h3 id="selectedDayTitle" class="text-lg font-semibold text-gray-800 mb-4"></h3>
                            <div id="selectedDayList" class="space-y-2">
                                <!-- Las acciones del día se mostrarán aquí -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Cierre de content-calendar tab -->

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
    
    // Guardar tab activo en localStorage
    localStorage.setItem('activeActionPlanTab', tabName);
    
    // Scroll al top
    window.scrollTo({ top: 0, behavior: 'instant' });
}

// Restaurar tab activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // ==================== TABLA: ORDENAMIENTO, PAGINACIÓN Y FILTROS ====================
    // Buscar filas en el tbody específico
    const tableBody = document.getElementById('tableBody');
    let allRows = tableBody ? Array.from(tableBody.querySelectorAll('tr[data-item-id]')) : [];
    
    console.log('Total de filas encontradas:', allRows.length);
    
    // Si no se encontraron filas, buscar de otra manera
    if (allRows.length === 0) {
        allRows = Array.from(document.querySelectorAll('#tableBody tr[data-item-id]'));
        console.log('Segunda búsqueda - filas encontradas:', allRows.length);
    }
    
    let filteredRows = [...allRows];
    let currentPage = 1;
    let itemsPerPage = 25;
    let currentSort = { column: 'order', direction: 'asc' };
    
    const searchInputListView = document.getElementById('searchListView');
    const sectionFilterListView = document.getElementById('filterSectionListView');
    const statusFilterListView = document.getElementById('filterStatusListView');
    const itemsPerPageSelect = document.getElementById('itemsPerPage');
    const prevPageBtn = document.getElementById('prevPageBtn');
    const nextPageBtn = document.getElementById('nextPageBtn');
    
    // Función para aplicar filtros
    function applyFilters() {
        const searchTerm = searchInputListView ? searchInputListView.value.toLowerCase() : '';
        const sectionFilter = sectionFilterListView ? sectionFilterListView.value : '';
        const statusFilter = statusFilterListView ? statusFilterListView.value : '';
        
        filteredRows = allRows.filter(row => {
            const description = row.dataset.description || '';
            const responsible = row.dataset.responsible || '';
            const section = row.dataset.section || '';
            const status = row.dataset.status || '';
            
            const matchesSearch = !searchTerm || description.includes(searchTerm) || responsible.includes(searchTerm);
            const matchesSection = !sectionFilter || section === sectionFilter;
            const matchesStatus = !statusFilter || status === statusFilter;
            
            return matchesSearch && matchesSection && matchesStatus;
        });
        
        currentPage = 1;
        applySorting();
    }
    
    // Función para aplicar ordenamiento
    function applySorting() {
        const { column, direction } = currentSort;
        
        filteredRows.sort((a, b) => {
            let valA, valB;
            
            switch(column) {
                case 'order':
                    valA = parseInt(a.dataset.order) || 0;
                    valB = parseInt(b.dataset.order) || 0;
                    break;
                case 'section':
                    valA = a.dataset.section || '';
                    valB = b.dataset.section || '';
                    break;
                case 'description':
                    valA = a.dataset.description || '';
                    valB = b.dataset.description || '';
                    break;
                case 'responsible':
                    valA = a.dataset.responsible || '';
                    valB = b.dataset.responsible || '';
                    break;
                case 'status':
                    const statusOrder = { 'pendiente': 1, 'en_proceso': 2, 'completado': 3 };
                    valA = statusOrder[a.dataset.status] || 0;
                    valB = statusOrder[b.dataset.status] || 0;
                    break;
                case 'date':
                    valA = a.dataset.date || '9999-99-99';
                    valB = b.dataset.date || '9999-99-99';
                    break;
                default:
                    return 0;
            }
            
            if (typeof valA === 'string') {
                return direction === 'asc' ? valA.localeCompare(valB) : valB.localeCompare(valA);
            } else {
                return direction === 'asc' ? valA - valB : valB - valA;
            }
        });
        
        renderTable();
    }
    
    // Función para renderizar la tabla con paginación
    function renderTable() {
        const tbody = document.getElementById('tableBody');
        const perPage = itemsPerPage === 'all' ? filteredRows.length : parseInt(itemsPerPage);
        const totalPages = Math.ceil(filteredRows.length / perPage) || 1;
        
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;
        
        const startIndex = (currentPage - 1) * perPage;
        const endIndex = Math.min(startIndex + perPage, filteredRows.length);
        const rowsToShow = filteredRows.slice(startIndex, endIndex);
        
        // Ocultar todas las filas primero
        allRows.forEach(row => row.style.display = 'none');
        
        // Mostrar solo las filas de la página actual
        rowsToShow.forEach(row => row.style.display = '');
        
        // Reordenar en el DOM
        const fragment = document.createDocumentFragment();
        filteredRows.forEach(row => fragment.appendChild(row));
        tbody.appendChild(fragment);
        
        // Actualizar información de paginación
        document.getElementById('showingFrom').textContent = filteredRows.length > 0 ? startIndex + 1 : 0;
        document.getElementById('showingTo').textContent = endIndex;
        document.getElementById('totalFiltered').textContent = filteredRows.length;
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;
        
        // Mostrar texto de filtrado si hay filtros activos
        const totalAll = allRows.length;
        const filteredText = document.getElementById('filteredText');
        if (filteredRows.length < totalAll) {
            filteredText.textContent = ` (filtrados de ${totalAll} total)`;
        } else {
            filteredText.textContent = '';
        }
        
        // Habilitar/deshabilitar botones de paginación
        prevPageBtn.disabled = currentPage <= 1;
        nextPageBtn.disabled = currentPage >= totalPages;
    }
    
    // Función para actualizar iconos de ordenamiento
    function updateSortIcons() {
        document.querySelectorAll('.sortable-header').forEach(header => {
            const icon = header.querySelector('.sort-icon');
            const column = header.dataset.sort;
            
            if (column === currentSort.column) {
                header.classList.add('bg-blue-50');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-blue-600');
                
                // Cambiar icono según dirección
                if (currentSort.direction === 'asc') {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>';
                }
            } else {
                header.classList.remove('bg-blue-50');
                icon.classList.add('text-gray-400');
                icon.classList.remove('text-blue-600');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>';
            }
        });
    }
    
    // Event listeners para ordenamiento
    document.querySelectorAll('.sortable-header').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.dataset.sort;
            
            if (currentSort.column === column) {
                // Toggle dirección
                currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
            } else {
                currentSort.column = column;
                currentSort.direction = 'asc';
            }
            
            updateSortIcons();
            applySorting();
        });
    });
    
    // Event listeners para filtros
    if (searchInputListView) {
        searchInputListView.addEventListener('input', applyFilters);
    }
    if (sectionFilterListView) {
        sectionFilterListView.addEventListener('change', applyFilters);
    }
    if (statusFilterListView) {
        statusFilterListView.addEventListener('change', applyFilters);
    }
    if (itemsPerPageSelect) {
        itemsPerPageSelect.addEventListener('change', function() {
            itemsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
    }
    
    // Event listeners para paginación
    if (prevPageBtn) {
        prevPageBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });
    }
    if (nextPageBtn) {
        nextPageBtn.addEventListener('click', function() {
            const perPage = itemsPerPage === 'all' ? filteredRows.length : parseInt(itemsPerPage);
            const totalPages = Math.ceil(filteredRows.length / perPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });
    }
    
    // Inicializar tabla
    updateSortIcons();
    renderTable();
    
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
    
    // Restaurar tab activo al final, después de inicializar todo
    const activeTab = localStorage.getItem('activeActionPlanTab') || 'components';
    switchTab(activeTab);
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

/* Kanban Cards */
.kanban-card {
    transition: all 0.2s ease;
}

.kanban-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.kanban-card.hidden-by-filter {
    display: none;
}

/* Line clamp for truncating text */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Kanban columns scrollbar */
#kanban-column-pendiente::-webkit-scrollbar,
#kanban-column-proceso::-webkit-scrollbar,
#kanban-column-completado::-webkit-scrollbar {
    width: 6px;
}

#kanban-column-pendiente::-webkit-scrollbar-thumb,
#kanban-column-proceso::-webkit-scrollbar-thumb,
#kanban-column-completado::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
}

#kanban-column-pendiente::-webkit-scrollbar-track,
#kanban-column-proceso::-webkit-scrollbar-track,
#kanban-column-completado::-webkit-scrollbar-track {
    background-color: rgba(0, 0, 0, 0.05);
}
</style>

<script>
// ==================== KANBAN FILTER ====================
function filterKanbanBySection(section) {
    const allCards = document.querySelectorAll('.kanban-card');
    let countPendiente = 0;
    let countProceso = 0;
    let countCompletado = 0;
    
    console.log('Filtering by section:', section);
    console.log('Total cards found:', allCards.length);
    
    allCards.forEach(card => {
        const cardSection = card.getAttribute('data-section') || '';
        const cardStatus = card.getAttribute('data-status') || '';
        
        // Comparación más flexible - verificar si contiene la sección
        const matches = section === '' || 
                       cardSection === section || 
                       cardSection.includes(section) ||
                       section.includes(cardSection);
        
        if (matches) {
            card.classList.remove('hidden-by-filter');
            card.style.display = 'block';
            
            // Contar por estado
            if (cardStatus === 'pendiente') countPendiente++;
            else if (cardStatus === 'en_proceso' || cardStatus === 'proceso') countProceso++;
            else if (cardStatus === 'completado') countCompletado++;
        } else {
            card.classList.add('hidden-by-filter');
            card.style.display = 'none';
        }
    });
    
    console.log('Counts:', { pendiente: countPendiente, proceso: countProceso, completado: countCompletado });
    
    // Actualizar contadores
    document.getElementById('kanban-count-pendiente').textContent = countPendiente;
    document.getElementById('kanban-count-proceso').textContent = countProceso;
    document.getElementById('kanban-count-completado').textContent = countCompletado;
}

// Actualizar Kanban cuando se cambia un item desde el modal
function updateKanbanCard(itemId, newStatus) {
    const card = document.querySelector(`.kanban-card[data-item-id="${itemId}"]`);
    if (!card) return;
    
    // Determinar columna destino
    let targetColumnId;
    if (newStatus === 'pendiente') {
        targetColumnId = 'kanban-column-pendiente';
    } else if (newStatus === 'en_proceso' || newStatus === 'proceso') {
        targetColumnId = 'kanban-column-proceso';
    } else {
        targetColumnId = 'kanban-column-completado';
    }
    
    const targetColumn = document.getElementById(targetColumnId);
    if (targetColumn && card.parentElement.id !== targetColumnId) {
        // Mover la tarjeta a la nueva columna
        targetColumn.appendChild(card);
        card.setAttribute('data-status', newStatus);
        
        // Actualizar contadores
        updateKanbanCounters();
    }
}

function updateKanbanCounters() {
    const pendienteCount = document.querySelectorAll('#kanban-column-pendiente .kanban-card:not(.hidden-by-filter)').length;
    const procesoCount = document.querySelectorAll('#kanban-column-proceso .kanban-card:not(.hidden-by-filter)').length;
    const completadoCount = document.querySelectorAll('#kanban-column-completado .kanban-card:not(.hidden-by-filter)').length;
    
    document.getElementById('kanban-count-pendiente').textContent = pendienteCount;
    document.getElementById('kanban-count-proceso').textContent = procesoCount;
    document.getElementById('kanban-count-completado').textContent = completadoCount;
}

// ==================== CALENDAR ====================
let currentCalendarDate = new Date();
@php
$calendarItemsData = $actionPlan->items->map(function($item) {
    return [
        'id' => $item->id,
        'action_name' => $item->action_name,
        'description' => $item->description,
        'status' => $item->status,
        'start_date' => $item->start_date ? $item->start_date->format('Y-m-d') : null,
        'end_date' => $item->end_date ? $item->end_date->format('Y-m-d') : null,
        'responsible' => $item->responsible,
        'comments' => $item->comments ?? '',
        'predecessor_action' => $item->predecessor_action ?? '',
        'business_days' => $item->business_days,
        'problems' => $item->problems ?? '',
        'corrective_measures' => $item->corrective_measures ?? '',
    ];
})->values()->toArray();
@endphp
const calendarItems = @json($calendarItemsData);

const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
                   'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

function renderCalendar() {
    const grid = document.getElementById('calendarGrid');
    const monthYearLabel = document.getElementById('currentMonthYear');
    
    if (!grid || !monthYearLabel) return;
    
    const year = currentCalendarDate.getFullYear();
    const month = currentCalendarDate.getMonth();
    
    monthYearLabel.textContent = `${monthNames[month]} ${year}`;
    
    // Primer día del mes
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startingDayOfWeek = firstDay.getDay();
    const daysInMonth = lastDay.getDate();
    
    // Limpiar grid
    grid.innerHTML = '';
    
    // Agregar días vacíos antes del primer día
    for (let i = 0; i < startingDayOfWeek; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'min-h-[100px] bg-gray-100 rounded';
        grid.appendChild(emptyDay);
    }
    
    // Agregar días del mes
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const currentDate = new Date(year, month, day);
        
        // Buscar items para este día
        const dayItems = calendarItems.filter(item => item.end_date === dateStr);
        
        const dayElement = document.createElement('div');
        dayElement.className = 'min-h-[100px] bg-white border border-gray-200 rounded p-2 cursor-pointer hover:bg-gray-50 transition-colors';
        
        // Marcar día actual
        if (currentDate.getTime() === today.getTime()) {
            dayElement.classList.add('ring-2', 'ring-indigo-500', 'bg-indigo-50');
        }
        
        // Número del día
        const dayNumber = document.createElement('div');
        dayNumber.className = 'text-sm font-semibold text-gray-700 mb-1';
        dayNumber.textContent = day;
        dayElement.appendChild(dayNumber);
        
        // Items del día (máximo 3 visibles)
        if (dayItems.length > 0) {
            const itemsContainer = document.createElement('div');
            itemsContainer.className = 'space-y-1';
            
            dayItems.slice(0, 3).forEach(item => {
                const itemBadge = document.createElement('div');
                
                // Determinar color según estado y si está vencida
                let bgColor = 'bg-gray-300';
                if (item.status === 'completado') {
                    bgColor = 'bg-green-500';
                } else if (item.status === 'en_proceso' || item.status === 'proceso') {
                    bgColor = 'bg-yellow-400';
                } else if (currentDate < today) {
                    bgColor = 'bg-red-500'; // Vencida
                }
                
                itemBadge.className = `${bgColor} text-white text-xs px-1 py-0.5 rounded truncate`;
                itemBadge.textContent = item.action_name;
                itemBadge.title = item.description;
                itemsContainer.appendChild(itemBadge);
            });
            
            if (dayItems.length > 3) {
                const moreLabel = document.createElement('div');
                moreLabel.className = 'text-xs text-gray-500 font-medium';
                moreLabel.textContent = `+${dayItems.length - 3} más`;
                itemsContainer.appendChild(moreLabel);
            }
            
            dayElement.appendChild(itemsContainer);
        }
        
        // Evento click para mostrar detalles del día
        dayElement.onclick = () => showDayDetails(dateStr, dayItems);
        
        grid.appendChild(dayElement);
    }
}

function changeCalendarMonth(delta) {
    currentCalendarDate.setMonth(currentCalendarDate.getMonth() + delta);
    renderCalendar();
}

function goToToday() {
    currentCalendarDate = new Date();
    renderCalendar();
}

function showDayDetails(dateStr, items) {
    const container = document.getElementById('selectedDayActions');
    const title = document.getElementById('selectedDayTitle');
    const list = document.getElementById('selectedDayList');
    
    if (!container || !title || !list) return;
    
    // Formatear fecha
    const date = new Date(dateStr + 'T00:00:00');
    const formattedDate = date.toLocaleDateString('es-PE', { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
    
    title.textContent = `Acciones para ${formattedDate}`;
    
    if (items.length === 0) {
        list.innerHTML = '<p class="text-gray-500 text-sm">No hay acciones programadas para este día</p>';
    } else {
        list.innerHTML = items.map(item => {
            let statusBadge = '';
            let statusColor = 'bg-gray-100 text-gray-700';
            
            if (item.status === 'completado') {
                statusBadge = '✓ Completado';
                statusColor = 'bg-green-100 text-green-700';
            } else if (item.status === 'en_proceso' || item.status === 'proceso') {
                statusBadge = '⏳ En Proceso';
                statusColor = 'bg-yellow-100 text-yellow-700';
            } else {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const itemDate = new Date(item.end_date + 'T00:00:00');
                if (itemDate < today) {
                    statusBadge = '⚠️ Vencida';
                    statusColor = 'bg-red-100 text-red-700';
                } else {
                    statusBadge = '○ Pendiente';
                }
            }
            
            return `
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors"
                     onclick="openEditModal(${item.id}, '${item.status}', \`${(item.comments || '').replace(/`/g, "'")}\`, '${item.predecessor_action || ''}', '${item.start_date || ''}', '${item.end_date || ''}', '${item.business_days || ''}', \`${(item.problems || '').replace(/`/g, "'")}\`, \`${(item.corrective_measures || '').replace(/`/g, "'")}\`)">
                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-mono font-bold text-blue-600">${item.action_name}</span>
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium ${statusColor}">${statusBadge}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">${item.description || ''}</p>
                        <p class="text-xs text-gray-500 mt-1">Responsable: ${item.responsible || 'Sin asignar'}</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            `;
        }).join('');
    }
    
    container.classList.remove('hidden');
    container.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Inicializar calendario cuando se muestre el tab
document.addEventListener('DOMContentLoaded', function() {
    // Observar cambios en el tab de calendario
    const calendarTab = document.getElementById('content-calendar');
    if (calendarTab) {
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'style' || mutation.attributeName === 'class') {
                    if (!calendarTab.classList.contains('hidden') && calendarTab.style.display !== 'none') {
                        renderCalendar();
                    }
                }
            });
        });
        observer.observe(calendarTab, { attributes: true });
    }
});
</script>
@endsection

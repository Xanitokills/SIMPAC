@extends('layouts.dashboard')

@section('page-title', 'Gestionar Plan de Acción')
@section('page-description', 'Vista tipo Lista/JIRA Editable')

@section('content')
<div class="space-y-6">
    <!-- Botón Regresar -->
    <div class="mb-2">
        <a href="{{ route('execution.entity', $actionPlan->entity_assignment_id) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>
    
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg text-white p-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div class="flex-1">
                <nav class="text-sm mb-2">
                    <ol class="flex items-center space-x-2 text-blue-100 flex-wrap">
                        <li><a href="{{ route('dashboard.execution') }}" class="hover:text-white">Ejecución</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li><a href="{{ route('execution.select-entity') }}" class="hover:text-white">Entidades</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li><a href="{{ route('execution.entity', $actionPlan->entity_assignment_id) }}" class="hover:text-white">
                            {{ $actionPlan->assignment->entity->name ?? 'Entidad' }}
                        </a></li>
                        <li><span class="mx-2">/</span></li>
                        <li><a href="{{ route('execution.action-plans.show', $actionPlan->id) }}" class="hover:text-white">Detalle del Plan</a></li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-white font-semibold">Gestionar</li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-bold">{{ $actionPlan->title }}</h2>
                <p class="text-blue-100 text-sm mt-2">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Creado: {{ $actionPlan->created_at->format('d/m/Y H:i') }}
                    @if($actionPlan->approval_date)
                        <span class="mx-2">|</span>
                        <svg class="w-4 h-4 inline mr-1 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Aprobado: {{ \Carbon\Carbon::parse($actionPlan->approval_date)->format('d/m/Y') }}
                    @endif
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('execution.action-plans.show', $actionPlan->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-blue-700 hover:bg-blue-50 rounded-lg font-semibold transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Ver Detalle
                </a>
                <button type="button" id="saveAllBtn" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Guardar Cambios
                </button>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $totalItems }}</h4>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pendientes</p>
                    <h4 class="text-2xl font-bold text-yellow-600">{{ $pendingItems }}</h4>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600 mb-1">En Proceso</p>
                    <h4 class="text-2xl font-bold text-blue-600">{{ $inProgressItems }}</h4>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Completados</p>
                    <h4 class="text-2xl font-bold text-green-600">{{ $completedItems }}</h4>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <div class="lg:col-span-2">
                <label for="searchInput" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar Acción
                </label>
                <input type="text" id="searchInput" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Buscar por descripción o responsable...">
            </div>
            <div>
                <label for="filterSection" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Sección
                </label>
                <select id="filterSection" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Todas las secciones</option>
                    @foreach($sections as $section)
                        <option value="{{ $section }}">{{ $section }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="filterStatus" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Estado
                </label>
                <select id="filterStatus" 
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
            <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
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
                    @foreach($items as $item)
                    <tr data-item-id="{{ $item->id }}" 
                        data-section="{{ $item->section_name }}" 
                        data-status="{{ $item->status }}"
                        class="hover:bg-gray-50 transition-colors">
                        <!-- Order -->
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->order }}
                        </td>
                        
                        <!-- Section -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="editable-cell" data-field="section_name">
                                <div class="view-mode flex items-center group">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 section-badge">
                                        {{ $item->section_name ?? 'Sin sección' }}
                                    </span>
                                    <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <!-- Description -->
                        <td class="px-4 py-3">
                            <div class="editable-cell" data-field="description">
                                <div class="view-mode group flex items-start">
                                    <span class="description-text text-sm text-gray-900 flex-1">{{ $item->description }}</span>
                                    <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer edit-icon flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <!-- Responsible -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="editable-cell" data-field="responsible">
                                <div class="view-mode flex items-center group">
                                    <span class="responsible-text text-sm text-gray-900">{{ $item->responsible ?? 'Sin asignar' }}</span>
                                    <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <!-- Status -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="editable-cell" data-field="status">
                                <div class="view-mode flex items-center group">
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
                                    <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <!-- Due Date -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="editable-cell" data-field="due_date">
                                <div class="view-mode flex items-center group">
                                    <span class="due-date-text text-sm {{ $item->due_date ? 'text-gray-900' : 'text-gray-400' }}">
                                        {{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') : 'Sin fecha' }}
                                    </span>
                                    <svg class="w-4 h-4 ml-2 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer edit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </div>
                                <div class="edit-mode hidden">
                                    <input type="date" value="{{ $item->due_date }}" 
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
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Hidden file input for uploads -->
<input type="file" id="fileInput" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">

<style>
/* Custom styles for editing */
tr.editing {
    background-color: #eff6ff !important;
}

tr.changed {
    background-color: #fef3c7 !important;
}

.edit-mode input,
.edit-mode textarea,
.edit-mode select {
    font-size: 0.875rem;
}

/* Sticky header */
#itemsTable thead {
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Max height for scrolling */
.overflow-x-auto {
    max-height: calc(100vh - 500px);
    overflow-y: auto;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const changedItems = new Map();
    
    // ==================== INLINE EDITING ====================
    
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.stopPropagation();
            const cell = this.closest('.editable-cell');
            enterEditMode(cell);
        });
    });
    
    document.querySelectorAll('.editable-cell .view-mode').forEach(viewMode => {
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
            case 'due_date':
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
                viewMode.querySelector('.responsible-text').textContent = newValue;
                break;
            case 'section_name':
                viewMode.querySelector('.section-badge').textContent = newValue;
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
            case 'due_date':
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
    
    document.querySelectorAll('.save-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, true);
        });
    });
    
    document.querySelectorAll('.cancel-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, false);
        });
    });
    
    document.querySelectorAll('.edit-mode input, .edit-mode textarea').forEach(input => {
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
    
    document.getElementById('saveAllBtn').addEventListener('click', async function() {
        if (changedItems.size === 0) {
            showNotification('No hay cambios pendientes para guardar.', 'info');
            return;
        }
        
        const btn = this;
        const originalHTML = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Guardando...';
        
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
                    row.classList.remove('changed');
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
            showNotification(`${successCount} item(s) actualizado(s) exitosamente.`, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(`${successCount} item(s) actualizado(s), ${errorCount} error(es).`, 'warning');
        }
    });
    
    // ==================== FILTERS ====================
    
    const searchInput = document.getElementById('searchInput');
    const filterSection = document.getElementById('filterSection');
    const filterStatus = document.getElementById('filterStatus');
    
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const section = filterSection.value;
        const status = filterStatus.value;
        
        document.querySelectorAll('#itemsTable tbody tr').forEach(row => {
            const description = row.querySelector('.description-text').textContent.toLowerCase();
            const responsible = row.querySelector('.responsible-text').textContent.toLowerCase();
            const rowSection = row.dataset.section;
            const rowStatus = row.dataset.status;
            
            const matchesSearch = searchTerm === '' || description.includes(searchTerm) || responsible.includes(searchTerm);
            const matchesSection = section === '' || rowSection === section;
            const matchesStatus = status === '' || rowStatus === status;
            
            if (matchesSearch && matchesSection && matchesStatus) {
                row.classList.remove('hidden');
            } else {
                row.classList.add('hidden');
            }
        });
    }
    
    searchInput.addEventListener('input', applyFilters);
    filterSection.addEventListener('change', applyFilters);
    filterStatus.addEventListener('change', applyFilters);
    
    // ==================== FILE UPLOAD ====================
    
    const fileInput = document.getElementById('fileInput');
    let currentUploadItemId = null;
    
    document.querySelectorAll('.upload-file-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentUploadItemId = this.dataset.itemId;
            fileInput.click();
        });
    });
    
    fileInput.addEventListener('change', async function() {
        if (!this.files.length || !currentUploadItemId) return;
        
        const formData = new FormData();
        formData.append('file', this.files[0]);
        
        try {
            const response = await fetch(`/dashboard/execution/action-plans/items/${currentUploadItemId}/file`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (response.ok) {
                showNotification('Archivo subido exitosamente.', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification('Error al subir el archivo.', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Error al subir el archivo.', 'error');
        }
        
        this.value = '';
        currentUploadItemId = null;
    });
    
    // ==================== FILE DELETE ====================
    
    document.querySelectorAll('.delete-file-btn').forEach(btn => {
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
                    showNotification('Archivo eliminado exitosamente.', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification('Error al eliminar el archivo.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error al eliminar el archivo.', 'error');
            }
        });
    });
    
    // ==================== HELPER FUNCTIONS ====================
    
    function showNotification(message, type = 'info') {
        const colors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'warning': 'bg-yellow-500',
            'info': 'bg-blue-500'
        };
        
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush
@endsection

@extends('layouts.dashboard')

@section('page-title', 'Detalle de Oficio')
@section('page-description', 'Información del documento enviado')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors" title="Inicio">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <a href="{{ route('activity2.show', $oficio->entityAssignment->id) }}" class="hover:text-blue-600 transition-colors">{{ $oficio->entityAssignment->entity->name }}</a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-gray-700 font-medium">Oficio #{{ $oficio->id }}</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Botón Regresar -->
    <div class="mb-4">
        <a href="{{ route('oficios.index', $oficio->entityAssignment->id) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar a Oficios</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Cabecera del Oficio -->
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg text-white p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ $oficio->subject }}</h1>
                    <p class="text-yellow-100 mt-1">{{ $oficio->entityAssignment->entity->name }}</p>
                    @if($oficio->oficio_number)
                        <p class="text-yellow-200 text-sm">Número: {{ $oficio->oficio_number }}</p>
                    @endif
                </div>
            </div>
            <div class="text-right">
                @php
                    $statusColors = [
                        'pendiente' => 'bg-yellow-400 text-yellow-900',
                        'cumplido' => 'bg-green-400 text-green-900',
                        'vencido' => 'bg-red-400 text-red-900',
                    ];
                    $statusLabels = [
                        'pendiente' => 'Pendiente',
                        'cumplido' => 'Cumplido',
                        'vencido' => 'Vencido',
                    ];
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$oficio->status] ?? 'bg-gray-400 text-gray-900' }}">
                    {{ $statusLabels[$oficio->status] ?? ucfirst($oficio->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Información del Oficio -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Información del Documento
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Tipo</label>
                <p class="text-gray-900">
                    @if($oficio->type === 'solicitud')
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Solicitud
                        </span>
                    @else
                        <span class="inline-flex items-center">
                            <svg class="w-4 h-4 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reiteración
                        </span>
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Fecha de Emisión</label>
                <p class="text-gray-900">{{ \Carbon\Carbon::parse($oficio->issue_date)->format('d/m/Y') }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Fecha Límite</label>
                <p class="text-gray-900 {{ $oficio->status === 'vencido' ? 'text-red-600 font-semibold' : '' }}">
                    {{ \Carbon\Carbon::parse($oficio->deadline_date)->format('d/m/Y') }}
                    @if($oficio->status === 'pendiente')
                        <span class="text-sm text-gray-500 ml-2">
                            ({{ \Carbon\Carbon::parse($oficio->deadline_date)->diffForHumans() }})
                        </span>
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Creado por</label>
                <p class="text-gray-900">{{ $oficio->creator->name ?? 'N/A' }}</p>
            </div>
        </div>
        
        @if($oficio->description)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <label class="block text-sm font-medium text-gray-500 mb-2">Descripción</label>
                <p class="text-gray-700">{{ $oficio->description }}</p>
            </div>
        @endif
    </div>

    <!-- Acto Resolutivo -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Respuesta / Acto Resolutivo
        </h2>
        
        @if($oficio->actoResolutivo)
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Número de Resolución</label>
                        <p class="text-gray-900 font-medium">{{ $oficio->actoResolutivo->resolution_number }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Fecha de Resolución</label>
                        <p class="text-gray-900">{{ \Carbon\Carbon::parse($oficio->actoResolutivo->resolution_date)->format('d/m/Y') }}</p>
                    </div>
                    @if($oficio->actoResolutivo->uploader)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Registrado por</label>
                            <p class="text-gray-900">{{ $oficio->actoResolutivo->uploader->name }}</p>
                        </div>
                    @endif
                    @if($oficio->actoResolutivo->notes)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Notas</label>
                            <p class="text-gray-700">{{ $oficio->actoResolutivo->notes }}</p>
                        </div>
                    @endif
                </div>
                
                @if($oficio->actoResolutivo->document_path)
                    <div class="mt-4 pt-4 border-t border-green-200">
                        <a href="{{ Storage::url($oficio->actoResolutivo->document_path) }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Ver Documento
                        </a>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-600 mb-4">Aún no se ha registrado respuesta de la entidad</p>
                
                @if($oficio->status !== 'cumplido')
                    <button type="button" 
                            onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Registrar Respuesta
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Acciones -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Acciones</h2>
        
        <div class="flex flex-wrap gap-3">
            @if($oficio->status === 'vencido' || $oficio->status === 'pendiente')
                <a href="{{ route('oficios.create.reiteration', $oficio->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Crear Reiteración
                </a>
            @endif
            
            <a href="{{ route('oficios.index', $oficio->entityAssignment->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Ver Todos los Oficios
            </a>
            
            <a href="{{ route('activity2.show', $oficio->entityAssignment->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                </svg>
                Volver a Entidad
            </a>
        </div>
    </div>
</div>

<!-- Modal para subir Acto Resolutivo -->
@if(!$oficio->actoResolutivo && $oficio->status !== 'cumplido')
<div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Registrar Respuesta</h3>
                <button type="button" 
                        onclick="document.getElementById('uploadModal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('oficios.upload.acto', $oficio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="resolution_number" class="block text-sm font-medium text-gray-700 mb-1">
                            Número de Resolución <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="resolution_number" 
                               id="resolution_number"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ej: RES-2024-001">
                    </div>
                    
                    <div>
                        <label for="resolution_date" class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha de Resolución <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="resolution_date" 
                               id="resolution_date"
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="document" class="block text-sm font-medium text-gray-700 mb-1">
                            Documento PDF <span class="text-red-500">*</span>
                        </label>
                        <input type="file" 
                               name="document" 
                               id="document"
                               required
                               accept=".pdf"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Máximo 10MB, solo PDF</p>
                    </div>
                    
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Notas (opcional)
                        </label>
                        <textarea name="notes" 
                                  id="notes"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Observaciones adicionales..."></textarea>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" 
                            onclick="document.getElementById('uploadModal').classList.add('hidden')"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Guardar Respuesta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

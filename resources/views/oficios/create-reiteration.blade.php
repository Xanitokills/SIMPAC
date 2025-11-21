@extends('layouts.dashboard')

@section('page-title', 'Crear Oficio de Reiteración')
@section('page-description', 'Reiterar solicitud a la entidad')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors" title="Inicio">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <a href="{{ route('oficios.show', $originalOficio->id) }}" class="hover:text-blue-600 transition-colors">Oficio Original</a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-gray-700 font-medium">Crear Reiteración</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Botón Regresar -->
    <div class="mb-4">
        <a href="{{ route('oficios.show', $originalOficio->id) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <strong>Por favor corrige los siguientes errores:</strong>
            </div>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Información del Oficio Original -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg text-white p-6 mb-6">
        <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Crear Oficio de Reiteración</h1>
                <p class="text-orange-100 mt-1">{{ $originalOficio->entityAssignment->entity->name }}</p>
                <p class="text-orange-200 text-sm">Oficio original: {{ $originalOficio->subject }}</p>
            </div>
        </div>
    </div>

    <!-- Resumen del Oficio Original -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-orange-500">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Oficio Original a Reiterar
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Asunto:</span>
                <p class="font-medium text-gray-900">{{ $originalOficio->subject }}</p>
            </div>
            <div>
                <span class="text-gray-500">Fecha de Emisión:</span>
                <p class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($originalOficio->issue_date)->format('d/m/Y') }}</p>
            </div>
            <div>
                <span class="text-gray-500">Fecha Límite Original:</span>
                <p class="font-medium text-red-600">{{ \Carbon\Carbon::parse($originalOficio->deadline_date)->format('d/m/Y') }}</p>
            </div>
            <div>
                <span class="text-gray-500">Estado:</span>
                <p class="font-medium">
                    @php
                        $statusColors = [
                            'pendiente' => 'text-yellow-600',
                            'vencido' => 'text-red-600',
                            'cumplido' => 'text-green-600',
                        ];
                    @endphp
                    <span class="{{ $statusColors[$originalOficio->status] ?? 'text-gray-600' }}">
                        {{ ucfirst($originalOficio->status) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Formulario de Reiteración -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Datos del Nuevo Oficio de Reiteración
        </h2>
        
        <form action="{{ route('oficios.store', $originalOficio->entityAssignment->id) }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="reiteracion">
            <input type="hidden" name="parent_oficio_id" value="{{ $originalOficio->id }}">
            
            <div class="space-y-6">
                <!-- Número de Oficio -->
                <div>
                    <label for="oficio_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Número de Oficio
                    </label>
                    <input type="text" 
                           name="oficio_number" 
                           id="oficio_number"
                           value="{{ old('oficio_number') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                           placeholder="Ej: OF-REIT-2024-001">
                </div>
                
                <!-- Asunto -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                        Asunto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="subject" 
                           id="subject"
                           required
                           value="{{ old('subject', 'REITERACIÓN: ' . $originalOficio->subject) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                           placeholder="Asunto del oficio de reiteración">
                </div>
                
                <!-- Fecha de Emisión -->
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha de Emisión <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="issue_date" 
                           id="issue_date"
                           required
                           value="{{ old('issue_date', date('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                </div>
                
                <!-- Nueva Fecha Límite -->
                <div>
                    <label for="deadline_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Nueva Fecha Límite <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="deadline_date" 
                           id="deadline_date"
                           required
                           value="{{ old('deadline_date') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                    <p class="text-sm text-gray-500 mt-1">Establezca una nueva fecha límite para la respuesta</p>
                </div>
                
                <!-- Descripción -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción / Motivación
                    </label>
                    <textarea name="description" 
                              id="description"
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-none"
                              placeholder="Indique el motivo de la reiteración y cualquier información adicional relevante...">{{ old('description', 'Se reitera el oficio original debido a que no se ha recibido respuesta dentro del plazo establecido.') }}</textarea>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('oficios.show', $originalOficio->id) }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Crear Oficio de Reiteración
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

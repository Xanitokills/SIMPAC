@extends('layouts.dashboard')

@section('page-title', 'Programar Reunión de Coordinación')
@section('page-description', 'Agendar reunión con sectorista para presentación de propuesta')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Botón Regresar -->
    <div class="mb-4">
        <a href="{{ isset($assignment) ? route('execution.entity', $assignment->id) : route('dashboard.execution') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Nueva Reunión de Coordinación</h2>
            <p class="text-sm text-gray-500 mt-1">Complete la información para programar una reunión con el sectorista</p>
        </div>

        <form action="{{ route('execution.meetings.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-6">
                @if(isset($assignment) && $assignment)
                    <!-- Asignación Pre-seleccionada (desde entity panel) -->
                    <input type="hidden" name="entity_assignment_id" value="{{ $assignment->id }}">
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-blue-900">Reunión para:</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p class="font-semibold">{{ $assignment->entity->name }}</p>
                                    <p class="text-xs mt-1">Sectorista: {{ $assignment->sectorista->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Seleccionar Asignación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Entidad / Sectorista <span class="text-red-500">*</span>
                        </label>
                        <select name="entity_assignment_id" required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Seleccione una entidad...</option>
                            @foreach($assignments as $assignmentItem)
                                <option value="{{ $assignmentItem->id }}">
                                    {{ $assignmentItem->entity->name }} - {{ $assignmentItem->sectorista->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('entity_assignment_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- Asunto -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Asunto de la Reunión <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="subject" required
                           value="{{ old('subject') }}"
                           placeholder="Ej: Presentación de propuesta de transferencia - Componente Presupuesto"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('subject')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha y Hora -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Fecha y Hora <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="scheduled_date" required
                               value="{{ old('scheduled_date') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('scheduled_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Link de Reunión Virtual
                        </label>
                        <input type="url" name="meeting_link"
                               value="{{ old('meeting_link') }}"
                               placeholder="https://meet.google.com/xxx-xxxx-xxx"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('meeting_link')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Datos de Contacto -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Datos de Contacto de la Entidad</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Contacto <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="contact_name" required
                                   value="{{ old('contact_name') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('contact_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email de Contacto
                            </label>
                            <input type="email" name="contact_email"
                                   value="{{ old('contact_email') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('contact_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Teléfono de Contacto
                            </label>
                            <input type="text" name="contact_phone"
                                   value="{{ old('contact_phone') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('contact_phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Componentes a Tratar -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Componentes de Transferencia a Tratar</h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                            <input type="checkbox" name="components[]" value="presupuesto"
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="text-sm text-gray-700">Presupuesto</span>
                        </label>

                        <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-purple-50 cursor-pointer">
                            <input type="checkbox" name="components[]" value="bienes"
                                   class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-gray-700">Bienes</span>
                        </label>

                        <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-green-50 cursor-pointer">
                            <input type="checkbox" name="components[]" value="acervo"
                                   class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <span class="text-sm text-gray-700">Acervo</span>
                        </label>

                        <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-orange-50 cursor-pointer">
                            <input type="checkbox" name="components[]" value="tecnologia"
                                   class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
                            <span class="text-sm text-gray-700">Tecnología</span>
                        </label>

                        <label class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-red-50 cursor-pointer">
                            <input type="checkbox" name="components[]" value="rrhh"
                                   class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="text-sm text-gray-700">RR.HH.</span>
                        </label>
                    </div>
                </div>

                <!-- Agenda -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Agenda / Temas a Tratar
                    </label>
                    <textarea name="agenda" rows="4"
                              placeholder="Detalle los temas que se tratarán en la reunión..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('agenda') }}</textarea>
                    @error('agenda')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notas Adicionales -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Notas Adicionales
                    </label>
                    <textarea name="notes" rows="3"
                              placeholder="Cualquier información adicional relevante..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard.execution') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Programar Reunión</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

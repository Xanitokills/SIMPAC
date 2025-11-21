@extends('layouts.dashboard')

@section('page-title', 'Cargar Documento Enviado')
@section('page-description', 'Registrar oficio enviado a la entidad')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors" title="Inicio">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <a href="{{ route('activity2.show', $assignment->id) }}" class="hover:text-blue-600 transition-colors">{{ $assignment->entity->name }}</a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-gray-700 font-medium">Cargar Documento</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Botón Regresar -->
    <div class="mb-4">
        <a href="{{ route('activity2.show', $assignment->id) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    <!-- Información de la Entidad -->
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg text-white p-6 mb-6">
        <div class="flex items-center">
            <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Cargar Documento Enviado</h1>
                <p class="text-yellow-100 mt-1">{{ $assignment->entity->name }}</p>
                <p class="text-yellow-200 text-sm">Sectorista: {{ $assignment->sectorista->name }}</p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Información del Oficio</h2>
            <p class="text-sm text-gray-600 mt-1">Complete los datos del documento enviado a la entidad</p>
        </div>

        <form action="{{ route('oficios.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tipo de Oficio -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                        Tipo de Documento <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror">
                        <option value="">Seleccione...</option>
                        <option value="solicitud" {{ old('type') == 'solicitud' ? 'selected' : '' }}>Oficio de Solicitud</option>
                        <option value="reiteracion" {{ old('type') == 'reiteracion' ? 'selected' : '' }}>Oficio de Reiteración</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Número de Oficio -->
                <div>
                    <label for="oficio_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Número de Oficio
                    </label>
                    <input type="text" name="oficio_number" id="oficio_number" 
                           value="{{ old('oficio_number') }}"
                           placeholder="Ej: OFICIO-001-2025"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('oficio_number') border-red-500 @enderror">
                    @error('oficio_number')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Asunto -->
                <div class="md:col-span-2">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                        Asunto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="subject" id="subject" required
                           value="{{ old('subject') }}"
                           placeholder="Asunto del oficio..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Emisión -->
                <div>
                    <label for="issue_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha de Emisión <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="issue_date" id="issue_date" required
                           value="{{ old('issue_date', date('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('issue_date') border-red-500 @enderror">
                    @error('issue_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha Límite de Respuesta -->
                <div>
                    <label for="deadline_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha Límite de Respuesta <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="deadline_date" id="deadline_date" required
                           value="{{ old('deadline_date') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('deadline_date') border-red-500 @enderror">
                    @error('deadline_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción / Observaciones
                    </label>
                    <textarea name="description" id="description" rows="3"
                              placeholder="Descripción adicional del documento..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Archivo del Oficio (opcional) -->
                <div class="md:col-span-2">
                    <label for="document_file" class="block text-sm font-medium text-gray-700 mb-1">
                        Archivo del Oficio (PDF)
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="document_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Subir archivo</span>
                                    <input id="document_file" name="document_file" type="file" accept=".pdf" class="sr-only">
                                </label>
                                <p class="pl-1">o arrastrar aquí</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF hasta 10MB</p>
                        </div>
                    </div>
                    <p id="file-name" class="mt-2 text-sm text-gray-600 hidden"></p>
                    @error('document_file')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('activity2.show', $assignment->id) }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Registrar Oficio
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Mostrar nombre del archivo seleccionado
document.getElementById('document_file').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name;
    const fileNameElement = document.getElementById('file-name');
    if (fileName) {
        fileNameElement.textContent = '📎 ' + fileName;
        fileNameElement.classList.remove('hidden');
    } else {
        fileNameElement.classList.add('hidden');
    }
});
</script>
@endsection

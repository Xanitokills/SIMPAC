@extends('layouts.dashboard')

@section('page-title', 'Registrar Plan de Implementación')
@section('page-description', 'Actividad 1: Registrar oficialmente el Plan de Implementación PGE vigente')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Botón Regresar -->
    <div class="mb-2">
        <a href="{{ route('implementation-plans.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    <!-- Información importante -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h3 class="text-blue-800 font-semibold">Información Importante</h3>
                <ul class="text-blue-700 text-sm mt-2 space-y-1 list-disc list-inside">
                    <li>Este plan es único para <strong>todas las entidades</strong></li>
                    <li>No puede haber 2 planes de implementación en curso</li>
                    <li>La fecha fin se registrará cuando se genere una modificación o actualización</li>
                    <li>Debe adjuntar el acto resolutivo (RD) en formato PDF</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Datos del Plan de Implementación</h3>
            <p class="text-sm text-gray-600 mt-1">Complete todos los campos obligatorios (*)</p>
        </div>

        <form action="{{ route('implementation-plans.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Tipo de Resolución -->
            <div>
                <label for="resolution_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Tipo de Acto Resolutivo *
                </label>
                <select 
                    name="resolution_type" 
                    id="resolution_type" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('resolution_type') border-red-500 @enderror"
                >
                    <option value="">Seleccione tipo</option>
                    <option value="RM" {{ old('resolution_type') == 'RM' ? 'selected' : '' }}>RM - Resolución Ministerial</option>
                    <option value="RD" {{ old('resolution_type') == 'RD' ? 'selected' : '' }}>RD - Resolución Directoral</option>
                    <option value="DS" {{ old('resolution_type') == 'DS' ? 'selected' : '' }}>DS - Decreto Supremo</option>
                </select>
                @error('resolution_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Número de Resolución -->
            <div>
                <label for="resolution_number" class="block text-sm font-medium text-gray-700 mb-2">
                    Número de Resolución *
                </label>
                <input 
                    type="text" 
                    name="resolution_number" 
                    id="resolution_number" 
                    value="{{ old('resolution_number') }}"
                    required
                    placeholder="Ej: RM-001-2025-MEF"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('resolution_number') border-red-500 @enderror"
                >
                @error('resolution_number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre del Plan -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre del Plan *
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    required
                    placeholder="Ej: Plan de Implementación de la PGE 2025"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                >
                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    placeholder="Breve descripción del plan de implementación..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                >{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha de Inicio -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Fecha de Inicio de Vigencia *
                </label>
                <input 
                    type="date" 
                    name="start_date" 
                    id="start_date" 
                    value="{{ old('start_date') }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('start_date') border-red-500 @enderror"
                >
                @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    La fecha fin se registrará automáticamente cuando se cierre este plan
                </p>
            </div>

            <!-- Documento PDF del Plan -->
            <div>
                <label for="pdf_document" class="block text-sm font-medium text-gray-700 mb-2">
                    Documento PDF del Plan de Implementación *
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                    <input 
                        type="file" 
                        name="pdf_document" 
                        id="pdf_document" 
                        accept=".pdf"
                        required
                        class="hidden"
                        onchange="displayFileName(this, 'file-name-plan')"
                    >
                    <label for="pdf_document" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-semibold text-blue-600">Haga clic para subir</span> o arrastre el archivo
                        </p>
                        <p class="mt-1 text-xs text-gray-500">PDF del Plan (máximo 10 MB)</p>
                        <p id="file-name-plan" class="mt-2 text-sm text-green-600 font-medium"></p>
                    </label>
                </div>
                @error('pdf_document')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Documento PDF de la Resolución (Opcional) -->
            <div>
                <label for="resolution_pdf" class="block text-sm font-medium text-gray-700 mb-2">
                    Documento PDF de la Resolución (Opcional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition-colors">
                    <input 
                        type="file" 
                        name="resolution_pdf" 
                        id="resolution_pdf" 
                        accept=".pdf"
                        class="hidden"
                        onchange="displayFileName(this, 'file-name-resolution')"
                    >
                    <label for="resolution_pdf" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-semibold text-green-600">Haga clic para subir</span> o arrastre el archivo
                        </p>
                        <p class="mt-1 text-xs text-gray-500">PDF de la Resolución (máximo 10 MB) - Opcional</p>
                        <p id="file-name-resolution" class="mt-2 text-sm text-green-600 font-medium"></p>
                    </label>
                </div>
                @error('resolution_pdf')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('implementation-plans.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Registrar Plan de Implementación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayFileName(input, displayId) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById(displayId);
    if (fileName) {
        fileNameDisplay.textContent = `✓ ${fileName}`;
    } else {
        fileNameDisplay.textContent = '';
    }
}
</script>
@endsection

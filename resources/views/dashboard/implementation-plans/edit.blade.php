@extends('layouts.dashboard')

@section('page-title', 'Editar Plan de Implementación')
@section('page-description', 'Modificar datos del Plan de Implementación PGE')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Información importante -->
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h3 class="text-yellow-800 font-semibold">Editar Plan Activo</h3>
                <p class="text-yellow-700 text-sm mt-1">
                    Solo puede editar la información básica del plan. Si desea cambiar las fechas de vigencia o realizar cambios mayores, debe cerrar este plan y crear uno nuevo.
                </p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Editar Datos del Plan</h3>
            <p class="text-sm text-gray-600 mt-1">Modifique los campos necesarios</p>
        </div>

        <form action="{{ route('implementation-plans.update', $implementationPlan) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

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
                    <option value="RM" {{ old('resolution_type', $implementationPlan->resolution_type) == 'RM' ? 'selected' : '' }}>RM - Resolución Ministerial</option>
                    <option value="RD" {{ old('resolution_type', $implementationPlan->resolution_type) == 'RD' ? 'selected' : '' }}>RD - Resolución Directoral</option>
                    <option value="DS" {{ old('resolution_type', $implementationPlan->resolution_type) == 'DS' ? 'selected' : '' }}>DS - Decreto Supremo</option>
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
                    value="{{ old('resolution_number', $implementationPlan->resolution_number) }}"
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
                    value="{{ old('name', $implementationPlan->name) }}"
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
                >{{ old('description', $implementationPlan->description) }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Información de fechas (solo lectura) -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h4 class="text-sm font-semibold text-gray-700 mb-3">Información de Vigencia</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Fecha de Inicio</p>
                        <p class="text-sm font-medium text-gray-900">{{ $implementationPlan->start_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Fecha de Fin</p>
                        <p class="text-sm font-medium text-gray-900">
                            {{ $implementationPlan->end_date ? $implementationPlan->end_date->format('d/m/Y') : 'Vigente' }}
                        </p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    Las fechas de vigencia no se pueden modificar desde aquí. Para cambiar la vigencia, debe cerrar este plan y crear uno nuevo.
                </p>
            </div>

            <!-- Documento PDF actual -->
            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-blue-900">Documento PDF actual</p>
                        <p class="text-xs text-blue-700 mt-1">Si sube un nuevo PDF, el documento anterior será reemplazado</p>
                        <a href="{{ Storage::url($implementationPlan->pdf_path) }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 underline mt-1 inline-block">
                            Ver documento actual
                        </a>
                    </div>
                </div>
            </div>

            <!-- Nuevo Documento PDF (opcional) -->
            <div>
                <label for="pdf_document" class="block text-sm font-medium text-gray-700 mb-2">
                    Actualizar Documento PDF (opcional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                    <input 
                        type="file" 
                        name="pdf_document" 
                        id="pdf_document" 
                        accept=".pdf"
                        class="hidden"
                        onchange="displayFileName(this)"
                    >
                    <label for="pdf_document" class="cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-semibold text-blue-600">Haga clic para subir</span> o arrastre el archivo
                        </p>
                        <p class="mt-1 text-xs text-gray-500">PDF (máximo 10 MB) - Opcional</p>
                        <p id="file-name" class="mt-2 text-sm text-green-600 font-medium"></p>
                    </label>
                </div>
                @error('pdf_document')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('implementation-plans.show', $implementationPlan) }}" class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    if (fileName) {
        fileNameDisplay.textContent = `Archivo seleccionado: ${fileName}`;
    } else {
        fileNameDisplay.textContent = '';
    }
}
</script>
@endsection

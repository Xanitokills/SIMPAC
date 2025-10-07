@extends('layouts.dashboard')

@section('page-title', 'Nueva Asignación de Entidades')
@section('page-description', 'Seleccione un sectorista y asigne una o varias entidades')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Plan Info -->
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
        <div class="flex items-start justify-between">
            <div class="flex items-start flex-1">
                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <h3 class="text-blue-800 font-semibold">Plan de Implementación</h3>
                    <p class="text-blue-700 text-sm mt-1">{{ $plan->plan_name }} ({{ $plan->resolution_type }}-{{ $plan->resolution_number }})</p>
                </div>
            </div>
            <a href="{{ route('entity-assignments.index', ['plan_id' => $plan->id]) }}" 
               class="ml-4 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                ← Volver a Asignaciones
            </a>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Asignación de Entidades</h3>
            <p class="text-sm text-gray-600 mt-1">Seleccione primero un sectorista y luego marque las entidades que desea asignarle</p>
        </div>

        <form action="{{ route('entity-assignments.store', ['plan_id' => $plan->id]) }}" method="POST" class="p-6 space-y-6" id="assignmentForm">
            @csrf

            <!-- PASO 1: Sectorista -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-full font-bold">1</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-sm font-semibold text-blue-900">Seleccione el Sectorista</h4>
                        <p class="text-xs text-blue-700 mt-1">Elija el operario que será responsable de las entidades</p>
                    </div>
                </div>
            </div>

            <!-- Selectorista -->
            <div>
                @if($sectoristas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($sectoristas as $sectorista)
                    <label class="relative flex items-start p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-all">
                        <input type="radio" name="sectorista_id" value="{{ $sectorista->id }}" 
                               {{ old('sectorista_id') == $sectorista->id ? 'checked' : '' }}
                               required
                               class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500">
                        <div class="ml-3 flex-1">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 font-semibold text-sm">
                                        {{ substr($sectorista->name, 0, 1) }}{{ substr(explode(' ', $sectorista->name)[1] ?? '', 0, 1) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $sectorista->name }}</p>
                                    <p class="text-xs text-gray-600">{{ $sectorista->position }}</p>
                                    @if($sectorista->email)
                                    <p class="text-xs text-gray-500">{{ $sectorista->email }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
                @else
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-yellow-800 text-sm font-semibold">No hay sectoristas activos disponibles</p>
                    <p class="text-yellow-700 text-xs mt-1">Debe registrar sectoristas antes de crear asignaciones.</p>
                </div>
                @endif
                @error('sectorista_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASO 2: Entidades -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <span class="flex items-center justify-center w-8 h-8 bg-green-500 text-white rounded-full font-bold">2</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <h4 class="text-sm font-semibold text-green-900">Seleccione las Entidades a Asignar</h4>
                        <p class="text-xs text-green-700 mt-1">Marque una o varias entidades para asignarlas al sectorista seleccionado</p>
                    </div>
                </div>
            </div>

            <!-- Lista de entidades -->
            <div>
                @if($entities->count() > 0)
                <div class="space-y-4">
                    @foreach($entities as $type => $entitiesByType)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-gray-700 uppercase">
                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                                <span class="text-xs text-gray-500 ml-2">({{ $entitiesByType->count() }} entidades)</span>
                            </h4>
                            <button type="button" class="text-xs text-blue-600 hover:text-blue-800 font-medium" 
                                    onclick="toggleGroup(this, '{{ $type }}')">
                                Seleccionar todas
                            </button>
                        </div>
                        <div class="p-4 space-y-2">
                            @foreach($entitiesByType as $entity)
                            <label class="flex items-start p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer group-{{ $type }}">
                                <input type="checkbox" name="entity_ids[]" value="{{ $entity->id }}" 
                                       class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 entity-checkbox">
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $entity->name }}</p>
                                    <p class="text-xs text-gray-600 mt-1">Código: <span class="font-semibold">{{ $entity->code }}</span></p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-lg text-center">
                    <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p class="mt-3 text-sm font-semibold text-yellow-800">No hay entidades disponibles para asignar</p>
                    <p class="text-xs text-yellow-700 mt-1">Todas las entidades ya tienen asignación activa.</p>
                </div>
                @endif
                @error('entity_ids')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('entity_ids.*')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-2 flex items-center text-xs text-gray-600">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Seleccionadas: <span id="selectedCount" class="font-semibold ml-1">0</span>
                </div>
            </div>

            <!-- Fecha de Asignación -->
            <div>
                <label for="assigned_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Fecha de Asignación *
                </label>
                <input 
                    type="date" 
                    name="assigned_date" 
                    id="assigned_date" 
                    value="{{ old('assigned_date', date('Y-m-d')) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('assigned_date') border-red-500 @enderror"
                >
                @error('assigned_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notas -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notas / Observaciones
                </label>
                <textarea 
                    name="notes" 
                    id="notes" 
                    rows="4"
                    placeholder="Notas sobre esta asignación, responsabilidades específicas, etc..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('notes') border-red-500 @enderror"
                >{{ old('notes') }}</textarea>
                @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info adicional -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h4 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Información Importante
                </h4>
                <ul class="text-sm text-gray-600 space-y-1 ml-7">
                    <li>• La asignación se creará con estado "Activa"</li>
                    <li>• El sectorista será responsable del seguimiento de esta entidad</li>
                    <li>• La fecha fin se establecerá cuando se complete o cancele la asignación</li>
                    <li>• Una entidad solo puede tener una asignación activa a la vez</li>
                </ul>
            </div>

            <!-- Botones -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('entity-assignments.index', ['plan_id' => $plan->id]) }}" 
                   class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    ← Cancelar
                </a>
                @if($entities->count() > 0 && $sectoristas->count() > 0)
                <button type="submit" id="submitBtn" disabled
                        class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                    Crear Asignaciones
                </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
// Contador de entidades seleccionadas
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.entity-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const submitBtn = document.getElementById('submitBtn');
    
    function updateCount() {
        const checked = document.querySelectorAll('.entity-checkbox:checked').length;
        selectedCount.textContent = checked;
        submitBtn.disabled = checked === 0;
    }
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCount);
    });
    
    updateCount();
});

// Función para seleccionar/deseleccionar todas las entidades de un tipo
function toggleGroup(button, type) {
    const container = button.closest('.border').querySelector('.p-4');
    const checkboxes = container.querySelectorAll('.entity-checkbox');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
    });
    
    button.textContent = allChecked ? 'Seleccionar todas' : 'Deseleccionar todas';
    
    // Actualizar contador
    const event = new Event('change');
    checkboxes[0]?.dispatchEvent(event);
}
</script>
@endsection

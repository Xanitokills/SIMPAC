@extends('layouts.dashboard')

@section('page-title', 'Registrar Plan de Acción Aprobado')
@section('page-description', 'Entidad: ' . $assignment->entity->name)

@section('content')
<div class="space-y-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header adicional -->
        <div class="mb-6">
            <p class="text-sm text-gray-500">Sectorista: {{ $assignment->sectorista->name }}</p>
        </div>

        <!-- Formulario -->
        <div class="bg-white rounded-lg shadow-md">
            <form action="{{ route('execution.action-plans.store', $assignment->id) }}" method="POST" id="actionPlanForm" class="p-6">
                @csrf

                <!-- Información general del plan -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Información General</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                Título del Plan de Acción <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Descripción
                            </label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="approval_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Aprobación <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="approval_date" 
                                   id="approval_date" 
                                   value="{{ old('approval_date', now()->format('Y-m-d')) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('approval_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Notas Adicionales
                            </label>
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Acciones del plan -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Acciones del Plan</h2>
                        <button type="button" 
                                onclick="addActionItem()"
                                class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                            + Agregar Acción
                        </button>
                    </div>

                    <div id="actionsContainer" class="space-y-4">
                        <!-- Las acciones se agregarán aquí dinámicamente -->
                    </div>

                    @error('items')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <a href="{{ route('execution.entity', $assignment->id) }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                        Registrar Plan de Acción
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- cierre de space-y-6 -->

<script>
let actionCounter = 0;

// Agregar una acción al iniciar la página
document.addEventListener('DOMContentLoaded', function() {
    addActionItem();
});

function addActionItem() {
    actionCounter++;
    const container = document.getElementById('actionsContainer');
    
    const actionHtml = `
        <div class="action-item border border-gray-300 rounded-lg p-4 bg-gray-50" id="action-${actionCounter}">
            <div class="flex justify-between items-start mb-3">
                <h3 class="font-semibold text-gray-700">Acción #${actionCounter}</h3>
                <button type="button" 
                        onclick="removeActionItem(${actionCounter})"
                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                    Eliminar
                </button>
            </div>
            
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción de la Acción <span class="text-red-500">*</span>
                    </label>
                    <textarea name="items[${actionCounter}][action_description]" 
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                              required></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Responsable <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="items[${actionCounter}][responsible]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha Límite <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="items[${actionCounter}][deadline]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', actionHtml);
}

function removeActionItem(id) {
    const element = document.getElementById(`action-${id}`);
    if (element) {
        // Verificar que quede al menos una acción
        const actionsCount = document.querySelectorAll('.action-item').length;
        if (actionsCount > 1) {
            element.remove();
        } else {
            alert('Debe haber al menos una acción en el plan.');
        }
    }
}
</script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Asignación') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de error -->
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('entity-assignments.update', $entityAssignment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Información de la Entidad (solo lectura) -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Entidad Asignada</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Nombre:</p>
                                    <p class="font-medium">{{ $entityAssignment->entity->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Código:</p>
                                    <p class="font-medium">{{ $entityAssignment->entity->code }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Tipo:</p>
                                    <p class="font-medium">
                                        @if($entityAssignment->entity->type === 'sector')
                                            Sector
                                        @elseif($entityAssignment->entity->type === 'institution')
                                            Institución
                                        @elseif($entityAssignment->entity->type === 'program')
                                            Programa
                                        @else
                                            {{ ucfirst($entityAssignment->entity->type) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Selectorista -->
                        <div class="mb-6">
                            <label for="sectorista_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Sectorista Asignado *
                            </label>
                            <select 
                                name="sectorista_id" 
                                id="sectorista_id"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('sectorista_id') border-red-500 @enderror">
                                <option value="">Seleccione un sectorista...</option>
                                @foreach($sectoristas as $sectorista)
                                    <option value="{{ $sectorista->id }}" 
                                            {{ old('sectorista_id', $entityAssignment->sectorista_id) == $sectorista->id ? 'selected' : '' }}>
                                        {{ $sectorista->name }} - {{ $sectorista->email }}
                                        @if($sectorista->employee_code)
                                            ({{ $sectorista->employee_code }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('sectorista_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">
                                Solo se muestran sectoristas activos.
                            </p>
                        </div>

                        <!-- Notas -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Notas / Observaciones
                            </label>
                            <textarea 
                                name="notes" 
                                id="notes"
                                rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('notes') border-red-500 @enderror"
                                placeholder="Ingrese notas u observaciones relevantes...">{{ old('notes', $entityAssignment->notes) }}</textarea>
                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Información adicional -->
                        <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Información</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>Solo puede cambiar el sectorista asignado.</li>
                                            <li>La entidad, plan de implementación y fecha de asignación no se pueden modificar.</li>
                                            <li>Para cambiar la entidad, debe cancelar esta asignación y crear una nueva.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('entity-assignments.show', $entityAssignment) }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

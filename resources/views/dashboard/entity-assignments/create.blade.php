@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Nueva Asignación de Entidades</h1>
                <p class="text-gray-600 mt-1">Plan: {{ $plan->name }}</p>
            </div>
            <a href="{{ route('entity-assignments.index', ['plan' => $plan->id]) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="mb-4 bg-slate-100 border border-slate-400 text-slate-700 px-4 py-3 rounded relative">
            <strong class="font-bold">¡Error!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('entity-assignments.store', ['plan' => $plan->id]) }}" method="POST">
            @csrf

            <!-- Paso 1: Seleccionar Sectorista -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    Paso 1: Seleccionar Sectorista
                </h3>
                <div>
                    <label for="sectorista_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Sectorista <span class="text-red-500">*</span>
                    </label>
                    <select name="sectorista_id" id="sectorista_id" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            required>
                        <option value="">Seleccione un sectorista</option>
                        @foreach($sectoristas as $sectorista)
                            <option value="{{ $sectorista->id }}" {{ old('sectorista_id') == $sectorista->id ? 'selected' : '' }}>
                                {{ $sectorista->name }} - {{ $sectorista->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('sectorista_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Paso 2: Seleccionar Entidades -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    Paso 2: Seleccionar Entidades
                </h3>

                <!-- Filtros de entidades -->
                <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="filter_type" class="block text-sm font-medium text-gray-700 mb-1">
                            Filtrar por Tipo
                        </label>
                        <select id="filter_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Todos los tipos</option>
                            <option value="ministerio">Ministerio</option>
                            <option value="organismo_publico">Organismo Público</option>
                            <option value="gobierno_regional">Gobierno Regional</option>
                            <option value="gobierno_local">Gobierno Local</option>
                            <option value="empresa_publica">Empresa Pública</option>
                        </select>
                    </div>
                    <div>
                        <label for="filter_sector" class="block text-sm font-medium text-gray-700 mb-1">
                            Filtrar por Sector
                        </label>
                        <input type="text" id="filter_sector" placeholder="Buscar por sector..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="filter_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Filtrar por Nombre
                        </label>
                        <input type="text" id="filter_name" placeholder="Buscar por nombre..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Selector rápido -->
                <div class="mb-4 flex items-center space-x-4">
                    <button type="button" onclick="selectAll()" class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 text-sm">
                        Seleccionar Todas
                    </button>
                    <button type="button" onclick="deselectAll()" class="px-3 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 text-sm">
                        Deseleccionar Todas
                    </button>
                    <span id="selected_count" class="text-sm text-gray-600">0 entidades seleccionadas</span>
                </div>

                <!-- Tabla de entidades -->
                <div class="border rounded-lg overflow-hidden" style="max-height: 500px; overflow-y: auto;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    <input type="checkbox" id="select_all" class="rounded border-gray-300">
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nombre
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Tipo
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Sector
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="entities_table">
                            @forelse($entities as $entity)
                                <tr class="entity-row hover:bg-gray-50" 
                                    data-type="{{ $entity->type }}" 
                                    data-sector="{{ strtolower($entity->sector) }}" 
                                    data-name="{{ strtolower($entity->name) }}">
                                    <td class="px-4 py-3">
                                        <input type="checkbox" name="entity_ids[]" value="{{ $entity->id }}" 
                                               class="entity-checkbox rounded border-gray-300 focus:ring-blue-500"
                                               {{ in_array($entity->id, old('entity_ids', [])) ? 'checked' : '' }}>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $entity->name }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded">
                                            {{ ucfirst(str_replace('_', ' ', $entity->type)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $entity->sector }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                        No hay entidades disponibles para asignar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @error('entity_ids')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notas opcionales -->
            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notas (opcional)
                </label>
                <textarea name="notes" id="notes" rows="3" 
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                          placeholder="Añade notas o instrucciones adicionales...">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('entity-assignments.index', ['plan' => $plan->id]) }}" 
                   class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-md transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                    Crear Asignaciones
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Contador de entidades seleccionadas
    function updateSelectedCount() {
        const checked = document.querySelectorAll('.entity-checkbox:checked').length;
        document.getElementById('selected_count').textContent = `${checked} entidades seleccionadas`;
    }

    // Seleccionar/deseleccionar todas
    document.getElementById('select_all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.entity-checkbox');
        checkboxes.forEach(cb => {
            if (!cb.closest('tr').style.display || cb.closest('tr').style.display !== 'none') {
                cb.checked = this.checked;
            }
        });
        updateSelectedCount();
    });

    function selectAll() {
        document.querySelectorAll('.entity-checkbox').forEach(cb => {
            if (!cb.closest('tr').style.display || cb.closest('tr').style.display !== 'none') {
                cb.checked = true;
            }
        });
        updateSelectedCount();
    }

    function deselectAll() {
        document.querySelectorAll('.entity-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('select_all').checked = false;
        updateSelectedCount();
    }

    // Actualizar contador al hacer clic en checkboxes individuales
    document.querySelectorAll('.entity-checkbox').forEach(cb => {
        cb.addEventListener('change', updateSelectedCount);
    });

    // Filtros
    const filterType = document.getElementById('filter_type');
    const filterSector = document.getElementById('filter_sector');
    const filterName = document.getElementById('filter_name');

    function applyFilters() {
        const typeValue = filterType.value.toLowerCase();
        const sectorValue = filterSector.value.toLowerCase();
        const nameValue = filterName.value.toLowerCase();

        document.querySelectorAll('.entity-row').forEach(row => {
            const type = row.dataset.type;
            const sector = row.dataset.sector;
            const name = row.dataset.name;

            const typeMatch = !typeValue || type === typeValue;
            const sectorMatch = !sectorValue || sector.includes(sectorValue);
            const nameMatch = !nameValue || name.includes(nameValue);

            if (typeMatch && sectorMatch && nameMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
                row.querySelector('.entity-checkbox').checked = false;
            }
        });

        updateSelectedCount();
    }

    filterType.addEventListener('change', applyFilters);
    filterSector.addEventListener('input', applyFilters);
    filterName.addEventListener('input', applyFilters);

    // Inicializar contador
    updateSelectedCount();
</script>
@endsection

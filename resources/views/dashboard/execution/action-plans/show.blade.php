@extends('layouts.dashboard')

@section('page-title', 'Detalle del Plan de Acción')
@section('page-description', $actionPlan->title)

@section('content')
<div class="space-y-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg text-white p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold">{{ $actionPlan->title }}</h1>
                    <p class="text-blue-100 mt-2">Plan de Acción Aprobado</p>
                    <p class="text-sm text-blue-200 mt-1">
                        Entidad: {{ $actionPlan->entityAssignment->entity->name }}
                    </p>
                    <p class="text-sm text-blue-200">
                        Sectorista: {{ $actionPlan->entityAssignment->sectorista->name }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-2 bg-white text-blue-700 rounded-lg font-semibold">
                        {{ $actionPlan->status === 'active' ? 'Activo' : 'Completado' }}
                    </span>
                </div>
            </div>
            
            <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-blue-200">Fecha de Aprobación:</span>
                    <span class="font-semibold ml-2">{{ $actionPlan->approval_date->format('d/m/Y') }}</span>
                </div>
                @if($actionPlan->description)
                    <div class="col-span-2">
                        <span class="text-blue-200">Descripción:</span>
                        <p class="mt-1">{{ $actionPlan->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Acciones</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $actionPlan->items->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">En Proceso</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $actionPlan->items->whereIn('status', ['en_proceso', 'proceso'])->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Completadas</p>
                        <p class="text-2xl font-bold text-green-600">{{ $actionPlan->items->where('status', 'finalizado')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de acciones -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Acciones del Plan</h2>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    @forelse($actionPlan->items as $item)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        @if($item->status === 'pendiente')
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">
                                                Pendiente
                                            </span>
                                        @elseif($item->status === 'en_proceso' || $item->status === 'proceso')
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">
                                                En Proceso
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                ✓ Finalizado
                                            </span>
                                        @endif
                                        
                                        @if($item->end_date)
                                            <span class="text-sm text-gray-600">
                                                Vence: {{ $item->end_date->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-gray-800 font-medium">
                                        <span class="text-xs text-gray-500">{{ $item->action_name }}</span> - {{ $item->description }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <span class="font-semibold">Responsable:</span> {{ $item->responsible }}
                                    </p>
                                    
                                    @if($item->predecessor_action)
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-semibold">Acción Predecesora:</span> {{ $item->predecessor_action }}
                                        </p>
                                    @endif
                                    
                                    @if($item->start_date && $item->end_date)
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-600">
                                            <span>
                                                <span class="font-semibold">Inicio:</span> {{ $item->start_date->format('d/m/Y') }}
                                            </span>
                                            <span>
                                                <span class="font-semibold">Fin:</span> {{ $item->end_date->format('d/m/Y') }}
                                            </span>
                                            @if($item->business_days)
                                                <span class="px-2 py-1 bg-blue-50 text-blue-700 text-xs rounded">
                                                    {{ $item->business_days }} días hábiles
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    @if($item->comments)
                                        <div class="mt-2 p-3 bg-blue-50 rounded-lg">
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Comentarios:</span> {{ $item->comments }}
                                            </p>
                                        </div>
                                    @endif

                                    @if($item->problems)
                                        <div class="mt-2 p-3 bg-yellow-50 rounded-lg">
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Problemas:</span> {{ $item->problems }}
                                            </p>
                                        </div>
                                    @endif

                                    @if($item->corrective_measures)
                                        <div class="mt-2 p-3 bg-green-50 rounded-lg">
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Medidas Correctivas:</span> {{ $item->corrective_measures }}
                                            </p>
                                        </div>
                                    @endif
                                    
                                    @if($item->attachments && count($item->attachments) > 0)
                                        <div class="mt-3">
                                            <p class="text-sm font-semibold text-gray-700 mb-2">Archivos Adjuntos:</p>
                                            <div class="space-y-2">
                                                @foreach($item->attachments as $index => $attachment)
                                                    <div class="flex items-center space-x-2 bg-gray-50 p-2 rounded">
                                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                                        </svg>
                                                        <a href="{{ route('execution.action-plans.items.download-file', ['item' => $item->id, 'index' => $index]) }}" 
                                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium flex-1">
                                                            {{ $attachment['filename'] ?? 'Archivo ' . ($index + 1) }}
                                                        </a>
                                                        <span class="text-xs text-gray-500">
                                                            {{ isset($attachment['size']) ? number_format($attachment['size'] / 1024, 1) . ' KB' : '' }}
                                                        </span>
                                                        <form action="{{ route('execution.action-plans.items.delete-file', ['item' => $item->id, 'index' => $index]) }}" 
                                                              method="POST" 
                                                              class="inline"
                                                              onsubmit="return confirm('¿Está seguro de eliminar este archivo?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <button onclick="openEditModal(
                                    {{ $item->id }}, 
                                    '{{ $item->status }}', 
                                    `{{ $item->comments ?? '' }}`,
                                    '{{ $item->predecessor_action ?? '' }}',
                                    '{{ $item->start_date ? $item->start_date->format('Y-m-d') : '' }}',
                                    '{{ $item->end_date ? $item->end_date->format('Y-m-d') : '' }}',
                                    '{{ $item->business_days ?? '' }}',
                                    `{{ $item->problems ?? '' }}`,
                                    `{{ $item->corrective_measures ?? '' }}`
                                )"
                                        class="ml-4 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No hay acciones registradas en este plan.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('execution.entity', $actionPlan->entityAssignment->id) }}" 
               class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                ← Volver al Panel de la Entidad
            </a>
            
            <button type="button" 
                    onclick="confirmDelete()" 
                    class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                🗑️ Eliminar Plan de Acción
            </button>
        </div>

        <!-- Formulario oculto para eliminación -->
        <form id="deleteForm" 
              action="{{ route('execution.action-plans.destroy', $actionPlan->id) }}" 
              method="POST" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- Modal para editar acción -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Actualizar Acción</h3>
                
                <div class="space-y-4 max-h-[70vh] overflow-y-auto">
                    <!-- Acción Predecesora -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Acción Predecesora
                        </label>
                        <input type="text" 
                               name="predecessor_action" 
                               id="editPredecessor"
                               placeholder="Ejemplo: 1.1.1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Ingrese el código de la acción predecesora (opcional)</p>
                    </div>

                    <!-- Fechas -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Inicio
                            </label>
                            <input type="date" 
                                   name="start_date" 
                                   id="editStartDate"
                                   onchange="calculateBusinessDays()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Término
                            </label>
                            <input type="date" 
                                   name="end_date" 
                                   id="editEndDate"
                                   onchange="calculateBusinessDays()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Días hábiles (calculado automáticamente) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Días Hábiles (calculado automáticamente)
                        </label>
                        <input type="number" 
                               name="business_days" 
                               id="editBusinessDays"
                               readonly
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed">
                    </div>
                    
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                                id="editStatus"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="pendiente">PENDIENTE</option>
                            <option value="en_proceso">PROCESO</option>
                            <option value="finalizado">FINALIZADO</option>
                        </select>
                    </div>

                    <!-- Problemas Presentados -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Problemas Presentados
                        </label>
                        <textarea name="problems" 
                                  id="editProblems"
                                  rows="2"
                                  placeholder="Describa los problemas encontrados durante la ejecución..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Medidas Correctivas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Medidas Correctivas
                        </label>
                        <textarea name="corrective_measures" 
                                  id="editCorrectiveMeasures"
                                  rows="2"
                                  placeholder="Describa las medidas correctivas aplicadas..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <!-- Comentarios -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Comentarios
                        </label>
                        <textarea name="comments" 
                                  id="editComments"
                                  rows="2"
                                  placeholder="Comentarios adicionales..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <!-- Archivo Adjunto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Documentos de Sustento (PDF o Excel)
                        </label>
                        <input type="file" 
                               name="file"
                               accept=".pdf,.xls,.xlsx"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF, XLS, XLSX (Máx. 10MB)</p>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                <button type="button" 
                        onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- cierre de space-y-6 -->

<script>
// Calcular días hábiles entre dos fechas (excluyendo sábados y domingos)
function calculateBusinessDays() {
    const startDate = document.getElementById('editStartDate').value;
    const endDate = document.getElementById('editEndDate').value;
    
    if (!startDate || !endDate) {
        document.getElementById('editBusinessDays').value = '';
        return;
    }
    
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    if (start > end) {
        alert('La fecha de inicio debe ser anterior a la fecha de término');
        document.getElementById('editBusinessDays').value = '';
        return;
    }
    
    let businessDays = 0;
    let currentDate = new Date(start);
    
    while (currentDate <= end) {
        const dayOfWeek = currentDate.getDay();
        // 0 = Domingo, 6 = Sábado
        if (dayOfWeek !== 0 && dayOfWeek !== 6) {
            businessDays++;
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }
    
    document.getElementById('editBusinessDays').value = businessDays;
}

function openEditModal(itemId, status, comments, predecessor = '', startDate = '', endDate = '', businessDays = '', problems = '', correctiveMeasures = '') {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    form.action = `/dashboard/execution/action-plans/items/${itemId}`;
    document.getElementById('editStatus').value = status;
    document.getElementById('editComments').value = comments || '';
    document.getElementById('editPredecessor').value = predecessor || '';
    document.getElementById('editStartDate').value = startDate || '';
    document.getElementById('editEndDate').value = endDate || '';
    document.getElementById('editBusinessDays').value = businessDays || '';
    document.getElementById('editProblems').value = problems || '';
    document.getElementById('editCorrectiveMeasures').value = correctiveMeasures || '';
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Cerrar modal al hacer clic fuera
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Confirmar eliminación del plan de acción
function confirmDelete() {
    if (confirm('⚠️ ¿Está seguro de que desea eliminar este plan de acción?\n\nSe eliminarán:\n- Todas las acciones del plan\n- Todos los archivos adjuntos\n- Todo el historial de cambios\n\nEsta acción NO se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection

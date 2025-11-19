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
            <form action="{{ route('execution.action-plans.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" id="actionPlanForm" class="p-6">
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
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">Acciones del Plan</h2>
                            <p class="text-sm text-gray-500 mt-1">
                                💡 <strong>Tip:</strong> Use "⚡ Acciones Estándar" para cargar automáticamente 7 acciones predefinidas y solo ajustar los detalles.
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <button type="button" 
                                    onclick="loadTemplate()"
                                    class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors flex items-center shadow-md"
                                    title="Cargar acciones estándar predefinidas automáticamente">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                ⚡ Usar Acciones Estándar
                            </button>
                            <button type="button" 
                                    onclick="addActionItem()"
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                + Agregar Acción Manual
                            </button>
                        </div>
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
    
    // Expandir todas las secciones antes de enviar el formulario
    const form = document.getElementById('actionPlanForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Expandir todas las secciones ocultas para que la validación funcione
            document.querySelectorAll('.section-content.hidden').forEach(section => {
                section.classList.remove('hidden');
            });
        });
    }
});

function addActionItem() {
    actionCounter++;
    const container = document.getElementById('actionsContainer');
    
    const actionHtml = `
        <div class="action-item border border-gray-300 rounded-lg p-4 bg-gray-50" id="action-${actionCounter}">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-semibold text-gray-700">Acción #${actionCounter}</h3>
                <button type="button" 
                        onclick="removeActionItem(${actionCounter})"
                        class="text-red-600 hover:text-red-800 text-sm font-medium">
                    Eliminar
                </button>
            </div>
            
            <div class="space-y-4">
                <!-- Nombre de la acción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre/Código de la Acción <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="items[${actionCounter}][action_name]" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ej: 1.1.1"
                           required>
                </div>

                <!-- Descripción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción de la Acción <span class="text-red-500">*</span>
                    </label>
                    <textarea name="items[${actionCounter}][description]" 
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                              required></textarea>
                </div>
                
                <!-- Responsable y Acción Predecesora -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Responsable <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="items[${actionCounter}][responsible]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ej: Comisión PGE - SIS"
                               required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Acción Predecesora
                        </label>
                        <input type="text" 
                               name="items[${actionCounter}][predecessor_action]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Ej: 1.1.1">
                    </div>
                </div>

                <!-- Fechas -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha de Inicio <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="items[${actionCounter}][start_date]" 
                               id="start_date_${actionCounter}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               onchange="calculateBusinessDays(${actionCounter})"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha de Término <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="items[${actionCounter}][end_date]" 
                               id="end_date_${actionCounter}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               onchange="calculateBusinessDays(${actionCounter})"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Días Hábiles (auto)
                        </label>
                        <input type="number" 
                               name="items[${actionCounter}][business_days]" 
                               id="business_days_${actionCounter}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100"
                               readonly>
                    </div>
                </div>

                <!-- Estado -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Estado <span class="text-red-500">*</span>
                    </label>
                    <select name="items[${actionCounter}][status]" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="pendiente" selected>Pendiente</option>
                        <option value="proceso">Proceso</option>
                        <option value="finalizado">Finalizado</option>
                    </select>
                </div>

                <!-- Comentarios -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Comentarios
                    </label>
                    <textarea name="items[${actionCounter}][comments]" 
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Observaciones generales"></textarea>
                </div>

                <!-- Problemas y Medidas Correctivas -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Problemas Presentados
                        </label>
                        <textarea name="items[${actionCounter}][problems]" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Describe los problemas encontrados"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Medidas Correctivas
                        </label>
                        <textarea name="items[${actionCounter}][corrective_measures]" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Acciones tomadas para resolver"></textarea>
                    </div>
                </div>

                <!-- Documentos de sustento -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Documentos de Sustento (PDF o Excel)
                    </label>
                    <input type="file" 
                           name="items_files_${actionCounter}[]" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           accept=".pdf,.xls,.xlsx"
                           multiple>
                    <p class="text-xs text-gray-500 mt-1">Puede seleccionar múltiples archivos PDF o Excel</p>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', actionHtml);
}

function calculateBusinessDays(id) {
    const startDateInput = document.getElementById(`start_date_${id}`);
    const endDateInput = document.getElementById(`end_date_${id}`);
    const businessDaysInput = document.getElementById(`business_days_${id}`);

    if (startDateInput.value && endDateInput.value) {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        
        if (endDate < startDate) {
            alert('La fecha de término debe ser posterior a la fecha de inicio');
            endDateInput.value = '';
            businessDaysInput.value = '';
            return;
        }

        let businessDays = 0;
        let currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            // 0 = Domingo, 6 = Sábado
            const dayOfWeek = currentDate.getDay();
            if (dayOfWeek !== 0 && dayOfWeek !== 6) {
                businessDays++;
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }

        businessDaysInput.value = businessDays;
    }
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

/**
 * Cargar plantilla predefinida de acciones
 */
async function loadTemplate() {
    // Confirmar con el usuario
    if (!confirm('⚡ ¿Desea cargar las acciones estándar predefinidas?\n\n' +
                 'El sistema llenará automáticamente el formulario con 42 acciones típicas organizadas en 7 secciones.\n' +
                 'Solo tendrá que ajustar los detalles específicos de su entidad.\n\n' +
                 'Nota: Esto reemplazará las acciones actuales.')) {
        return;
    }

    try {
        // Mostrar loading
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 mr-2 inline" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Cargando...';

        // Obtener la plantilla del servidor
        const response = await fetch('{{ route("execution.action-plans.template") }}', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        });

        if (!response.ok) {
            throw new Error('Error al cargar la plantilla');
        }

        const data = await response.json();
        
        if (!data.success || !data.data || data.data.length === 0) {
            throw new Error('No hay plantillas disponibles');
        }

        // Limpiar acciones existentes
        const container = document.getElementById('actionsContainer');
        container.innerHTML = '';
        
        // Resetear contador
        actionCounter = 0;

        // Agrupar acciones por sección
        const sections = {};
        data.data.forEach(template => {
            const section = template.section || 'Sin sección';
            if (!sections[section]) {
                sections[section] = [];
            }
            sections[section].push(template);
        });

        // Crear secciones colapsables
        Object.keys(sections).forEach((sectionName, sectionIndex) => {
            const sectionId = `section-${sectionIndex}`;
            const isOpen = true; // TODAS las secciones abiertas por defecto
            
            // Header de la sección (colapsable)
            const sectionHeader = `
                <div class="section-header bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-4 mb-2 cursor-pointer hover:from-blue-700 hover:to-blue-800 transition-colors" onclick="toggleSection('${sectionId}')">
                    <div class="flex justify-between items-center text-white">
                        <div class="flex items-center">
                            <svg id="icon-${sectionId}" class="w-5 h-5 mr-3 transform transition-transform ${isOpen ? 'rotate-90' : ''}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <h3 class="text-lg font-bold">${sectionName}</h3>
                        </div>
                        <span class="bg-white text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                            ${sections[sectionName].length} ${sections[sectionName].length === 1 ? 'acción' : 'acciones'}
                        </span>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', sectionHeader);
            
            // Contenedor de acciones de la sección
            const sectionContent = document.createElement('div');
            sectionContent.id = sectionId;
            sectionContent.className = `section-content space-y-4 mb-6 ${isOpen ? '' : 'hidden'}`;
            
            // Crear cada acción de la sección
            sections[sectionName].forEach((template, index) => {
                const id = actionCounter++;
                
                const actionHtml = `
                    <div class="action-item border-2 border-gray-300 rounded-lg p-4 bg-white shadow-sm hover:shadow-md transition-shadow ml-8" id="action-${id}">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-md font-semibold text-gray-800 flex items-center">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded mr-2 text-sm font-mono">${template.code}</span>
                                ${template.name}
                            </h4>
                            <button type="button" 
                                    onclick="removeActionItem(${id})"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                ✕ Eliminar
                            </button>
                        </div>

                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Código de Acción <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="items[${id}][action_name]" 
                                   value="${template.code}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Ej: 1.1.1"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Responsable(s) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="items[${id}][responsible]" 
                                   value="${template.default_responsible || ''}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Ej: Comisión PGE - SIS"
                                   required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción de la Acción <span class="text-red-500">*</span>
                        </label>
                        <textarea name="items[${id}][description]" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Describe qué se debe realizar"
                                  required>${template.description}</textarea>
                    </div>

                    <div class="grid grid-cols-4 gap-3 mb-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Acción Predecesora
                            </label>
                            <input type="text" 
                                   name="items[${id}][predecessor_action]" 
                                   value="${template.predecessor_action || ''}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Ej: 1.1.1">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Inicio
                            </label>
                            <input type="date" 
                                   name="items[${id}][start_date]" 
                                   id="start_date_${id}"
                                   onchange="calculateBusinessDays(${id})"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Término <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="items[${id}][end_date]" 
                                   id="end_date_${id}"
                                   onchange="calculateBusinessDays(${id})"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Días Hábiles
                            </label>
                            <input type="number" 
                                   name="items[${id}][business_days]" 
                                   id="business_days_${id}"
                                   value="${template.default_business_days || ''}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100"
                                   readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select name="items[${id}][status]" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="pendiente" selected>PENDIENTE</option>
                            <option value="proceso">PROCESO</option>
                            <option value="finalizado">FINALIZADO</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Comentarios
                        </label>
                        <textarea name="items[${id}][comments]" 
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Observaciones generales"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Problemas Presentados
                            </label>
                            <textarea name="items[${id}][problems]" 
                                      rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Describe los problemas encontrados"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Medidas Correctivas
                            </label>
                            <textarea name="items[${id}][corrective_measures]" 
                                      rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Acciones tomadas para resolver"></textarea>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Documentos de Sustento (PDF o Excel)
                        </label>
                        <input type="file" 
                               name="items_files_${id}[]" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                               accept=".pdf,.xls,.xlsx"
                               multiple>
                        <p class="text-xs text-gray-500 mt-1">Puede seleccionar múltiples archivos PDF o Excel</p>
                    </div>
                </div>
            `;
                
                sectionContent.insertAdjacentHTML('beforeend', actionHtml);
            });
            
            container.appendChild(sectionContent);
        });

        // Restaurar botón
        btn.disabled = false;
        btn.innerHTML = originalText;

        // Mostrar mensaje de éxito
        const totalSections = Object.keys(sections).length;
        const totalActions = data.data.length;
        
        console.log(`✅ Plantilla cargada: ${totalActions} acciones en ${totalSections} secciones`);
        console.log('Secciones:', Object.keys(sections));
        
        alert(`✅ ¡Plantilla cargada exitosamente!\n\n📋 ${totalActions} acciones cargadas\n📁 ${totalSections} secciones organizadas\n\n💡 Todas las secciones están visibles.\n💡 Haz clic en las barras azules para contraer/expandir.\n\n⚠️ IMPORTANTE: Complete las fechas requeridas antes de guardar.`);

        // Scroll al primer elemento
        const firstSection = document.querySelector('.section-header');
        if (firstSection) {
            firstSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

    } catch (error) {
        console.error('Error al cargar plantilla:', error);
        alert('Error al cargar la plantilla: ' + error.message);
        
        // Restaurar botón en caso de error
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    }
}

/**
 * Toggle (expandir/contraer) una sección
 */
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    const icon = document.getElementById('icon-' + sectionId);
    
    if (section && icon) {
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
            icon.classList.add('rotate-90');
        } else {
            section.classList.add('hidden');
            icon.classList.remove('rotate-90');
        }
    }
}
</script>
@endsection

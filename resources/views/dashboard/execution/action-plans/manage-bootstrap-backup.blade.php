@extends('layouts.dashboard')

@section('title', 'Gestionar Plan de Acción')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-2">
                    <i class="fas fa-tasks text-primary me-2"></i>
                    Gestionar Plan de Acción
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.execution') }}">Ejecución</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('execution.select-entity') }}">Entidades</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('execution.entity', $actionPlan->entity_assignment_id) }}">
                                {{ $actionPlan->assignment->entity->name ?? 'Entidad' }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('execution.action-plans.show', $actionPlan->id) }}">Detalle del Plan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Gestionar</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="{{ route('execution.action-plans.show', $actionPlan->id) }}" class="btn btn-outline-secondary me-2">
                    <i class="fas fa-eye me-1"></i> Ver Detalle
                </a>
                <button type="button" class="btn btn-success" id="saveAllBtn">
                    <i class="fas fa-save me-1"></i> Guardar Cambios
                </button>
            </div>
        </div>

        <!-- Plan Info Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-2">
                            <span class="badge bg-primary me-2">{{ $actionPlan->assignment->entity->name ?? 'N/A' }}</span>
                            {{ $actionPlan->title }}
                        </h5>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Creado: {{ $actionPlan->created_at->format('d/m/Y H:i') }}
                            @if($actionPlan->approval_date)
                                | <i class="fas fa-check-circle text-success me-1"></i> 
                                Aprobado: {{ \Carbon\Carbon::parse($actionPlan->approval_date)->format('d/m/Y') }}
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="text-center">
                                <div class="h4 mb-0 text-primary">{{ $totalItems }}</div>
                                <small class="text-muted">Total</small>
                            </div>
                            <div class="text-center">
                                <div class="h4 mb-0 text-warning">{{ $pendingItems }}</div>
                                <small class="text-muted">Pendientes</small>
                            </div>
                            <div class="text-center">
                                <div class="h4 mb-0 text-info">{{ $inProgressItems }}</div>
                                <small class="text-muted">En Proceso</small>
                            </div>
                            <div class="text-center">
                                <div class="h4 mb-0 text-success">{{ $completedItems }}</div>
                                <small class="text-muted">Completados</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Buscar</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Buscar por descripción...">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Sección</label>
                    <select class="form-select" id="filterSection">
                        <option value="">Todas las secciones</option>
                        @foreach($sections as $section)
                            <option value="{{ $section }}">{{ $section }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Estado</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">Todos los estados</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en_proceso">En Proceso</option>
                        <option value="completado">Completado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Responsable</label>
                    <select class="form-select" id="filterResponsible">
                        <option value="">Todos</option>
                        @foreach($responsibles as $responsible)
                            <option value="{{ $responsible }}">{{ $responsible }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-secondary w-100" id="clearFiltersBtn">
                        <i class="fas fa-times me-1"></i> Limpiar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Items Table (JIRA-style) -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="actionItemsTable">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%;" class="text-center">#</th>
                            <th style="width: 30%;">Acción / Tarea</th>
                            <th style="width: 15%;">Sección</th>
                            <th style="width: 15%;">Responsable</th>
                            <th style="width: 10%;" class="text-center">Estado</th>
                            <th style="width: 10%;" class="text-center">Fecha Límite</th>
                            <th style="width: 10%;" class="text-center">Evidencia</th>
                            <th style="width: 5%;" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr data-item-id="{{ $item->id }}" class="item-row">
                            <!-- Order Number -->
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $item->order }}</span>
                            </td>

                            <!-- Description (Editable) -->
                            <td>
                                <div class="editable-cell" data-field="description">
                                    <div class="view-mode">
                                        <span class="description-text">{{ $item->description }}</span>
                                        <i class="fas fa-pencil-alt text-muted ms-2 edit-icon" role="button"></i>
                                    </div>
                                    <div class="edit-mode d-none">
                                        <textarea class="form-control form-control-sm" rows="2">{{ $item->description }}</textarea>
                                        <div class="mt-1">
                                            <button class="btn btn-sm btn-success save-edit me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Section (Editable) -->
                            <td>
                                <div class="editable-cell" data-field="section_name">
                                    <div class="view-mode">
                                        <span class="badge bg-info text-dark section-badge">{{ $item->section_name ?? 'Sin sección' }}</span>
                                        <i class="fas fa-pencil-alt text-muted ms-2 edit-icon" role="button"></i>
                                    </div>
                                    <div class="edit-mode d-none">
                                        <select class="form-select form-select-sm">
                                            @foreach($sections as $section)
                                                <option value="{{ $section }}" {{ $item->section_name === $section ? 'selected' : '' }}>
                                                    {{ $section }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="mt-1">
                                            <button class="btn btn-sm btn-success save-edit me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Responsible (Editable) -->
                            <td>
                                <div class="editable-cell" data-field="responsible">
                                    <div class="view-mode">
                                        <span class="responsible-text">{{ $item->responsible }}</span>
                                        <i class="fas fa-pencil-alt text-muted ms-2 edit-icon" role="button"></i>
                                    </div>
                                    <div class="edit-mode d-none">
                                        <input type="text" class="form-control form-control-sm" value="{{ $item->responsible }}">
                                        <div class="mt-1">
                                            <button class="btn btn-sm btn-success save-edit me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Status (Editable) -->
                            <td class="text-center">
                                <div class="editable-cell" data-field="status">
                                    <div class="view-mode">
                                        @php
                                            $statusClasses = [
                                                'pendiente' => 'warning',
                                                'en_proceso' => 'info',
                                                'completado' => 'success'
                                            ];
                                            $statusLabels = [
                                                'pendiente' => 'Pendiente',
                                                'en_proceso' => 'En Proceso',
                                                'completado' => 'Completado'
                                            ];
                                            $badgeClass = $statusClasses[$item->status] ?? 'secondary';
                                            $statusLabel = $statusLabels[$item->status] ?? $item->status;
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }} status-badge">{{ $statusLabel }}</span>
                                        <i class="fas fa-pencil-alt text-muted ms-2 edit-icon" role="button"></i>
                                    </div>
                                    <div class="edit-mode d-none">
                                        <select class="form-select form-select-sm">
                                            <option value="pendiente" {{ $item->status === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="en_proceso" {{ $item->status === 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                            <option value="completado" {{ $item->status === 'completado' ? 'selected' : '' }}>Completado</option>
                                        </select>
                                        <div class="mt-1">
                                            <button class="btn btn-sm btn-success save-edit me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Due Date (Editable) -->
                            <td class="text-center">
                                <div class="editable-cell" data-field="due_date">
                                    <div class="view-mode">
                                        @php
                                            $dateToShow = $item->due_date ?? $item->end_date;
                                        @endphp
                                        @if($dateToShow)
                                            @php
                                                $dueDate = \Carbon\Carbon::parse($dateToShow);
                                                $isPastDue = $dueDate->isPast() && $item->status !== 'completado';
                                            @endphp
                                            <span class="due-date-text {{ $isPastDue ? 'text-danger fw-bold' : '' }}">
                                                {{ $dueDate->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="text-muted">Sin fecha</span>
                                        @endif
                                        <i class="fas fa-pencil-alt text-muted ms-2 edit-icon" role="button"></i>
                                    </div>
                                    <div class="edit-mode d-none">
                                        @php
                                            $dateValue = $item->due_date ?? $item->end_date;
                                        @endphp
                                        <input type="date" class="form-control form-control-sm" 
                                               value="{{ $dateValue ? \Carbon\Carbon::parse($dateValue)->format('Y-m-d') : '' }}">
                                        <div class="mt-1">
                                            <button class="btn btn-sm btn-success save-edit me-1">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary cancel-edit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Evidence File -->
                            <td class="text-center">
                                @if($item->evidence_file)
                                    <a href="{{ route('execution.action-plans.items.download-file', $item->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Descargar evidencia">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger delete-file-btn" 
                                            data-item-id="{{ $item->id }}"
                                            title="Eliminar archivo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-secondary upload-file-btn" 
                                            data-item-id="{{ $item->id }}"
                                            title="Subir evidencia">
                                        <i class="fas fa-upload"></i>
                                    </button>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item view-history-btn" href="#" data-item-id="{{ $item->id }}">
                                                <i class="fas fa-history me-2"></i> Ver Historial
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger delete-item-btn" href="#" data-item-id="{{ $item->id }}">
                                                <i class="fas fa-trash me-2"></i> Eliminar Item
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No hay items en este plan de acción
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for File Upload -->
<div class="modal fade" id="uploadFileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir Evidencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="uploadFileForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="uploadItemId" name="item_id">
                    <div class="mb-3">
                        <label for="evidenceFile" class="form-label">Seleccionar archivo</label>
                        <input type="file" class="form-control" id="evidenceFile" name="evidence_file" required>
                        <div class="form-text">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG (Max: 5MB)</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Editable cells */
    .editable-cell {
        position: relative;
        min-height: 30px;
    }
    
    .editable-cell .view-mode {
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 0.25rem;
        transition: background-color 0.2s;
    }
    
    .editable-cell .view-mode:hover {
        background-color: #f8f9fa;
    }
    
    .editable-cell .edit-icon {
        opacity: 0;
        transition: opacity 0.2s;
        font-size: 0.75rem;
    }
    
    .editable-cell:hover .edit-icon {
        opacity: 0.6;
    }
    
    .editable-cell .edit-icon:hover {
        opacity: 1;
    }
    
    /* Row highlighting */
    .item-row.editing {
        background-color: #fff3cd !important;
    }
    
    .item-row.changed {
        border-left: 3px solid #28a745;
        background-color: #d4edda;
    }
    
    /* Status badges */
    .status-badge {
        min-width: 90px;
        display: inline-block;
    }
    
    /* Past due dates */
    .text-danger.fw-bold {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }
    
    /* Table responsive improvements */
    .table-responsive {
        max-height: 70vh;
        overflow-y: auto;
    }
    
    .table thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const changedItems = new Map();
    
    // ==================== INLINE EDITING ====================
    
    // Handle edit icon click
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.stopPropagation();
            const cell = this.closest('.editable-cell');
            enterEditMode(cell);
        });
    });
    
    // Handle view-mode click
    document.querySelectorAll('.editable-cell .view-mode').forEach(viewMode => {
        viewMode.addEventListener('click', function(e) {
            if (!e.target.classList.contains('edit-icon')) {
                const cell = this.closest('.editable-cell');
                enterEditMode(cell);
            }
        });
    });
    
    function enterEditMode(cell) {
        const viewMode = cell.querySelector('.view-mode');
        const editMode = cell.querySelector('.edit-mode');
        
        viewMode.classList.add('d-none');
        editMode.classList.remove('d-none');
        
        // Focus on input/textarea/select
        const input = editMode.querySelector('input, textarea, select');
        if (input) {
            input.focus();
            if (input.tagName === 'TEXTAREA' || input.type === 'text') {
                input.select();
            }
        }
        
        // Mark row as editing
        cell.closest('tr').classList.add('editing');
    }
    
    function exitEditMode(cell, save = false) {
        const viewMode = cell.querySelector('.view-mode');
        const editMode = cell.querySelector('.edit-mode');
        const row = cell.closest('tr');
        const itemId = row.dataset.itemId;
        const field = cell.dataset.field;
        
        if (save) {
            const input = editMode.querySelector('input, textarea, select');
            const newValue = input.value.trim();
            const oldValue = getViewModeValue(cell);
            
            if (newValue !== oldValue) {
                // Update view mode
                updateViewMode(cell, newValue);
                
                // Track change
                if (!changedItems.has(itemId)) {
                    changedItems.set(itemId, {});
                }
                changedItems.get(itemId)[field] = newValue;
                
                // Mark row as changed
                row.classList.add('changed');
                
                // Show save notification
                showNotification('Campo actualizado. Haz clic en "Guardar Cambios" para confirmar.', 'info');
            }
        }
        
        editMode.classList.add('d-none');
        viewMode.classList.remove('d-none');
        row.classList.remove('editing');
    }
    
    function getViewModeValue(cell) {
        const field = cell.dataset.field;
        const viewMode = cell.querySelector('.view-mode');
        
        switch(field) {
            case 'description':
                return viewMode.querySelector('.description-text')?.textContent.trim() || '';
            case 'responsible':
                return viewMode.querySelector('.responsible-text')?.textContent.trim() || '';
            case 'section_name':
                return viewMode.querySelector('.section-badge')?.textContent.trim() || '';
            case 'status':
                const select = cell.querySelector('.edit-mode select');
                return select?.value || '';
            case 'due_date':
                const input = cell.querySelector('.edit-mode input[type="date"]');
                return input?.value || '';
            default:
                return '';
        }
    }
    
    function updateViewMode(cell, newValue) {
        const field = cell.dataset.field;
        const viewMode = cell.querySelector('.view-mode');
        
        switch(field) {
            case 'description':
                viewMode.querySelector('.description-text').textContent = newValue;
                break;
            case 'responsible':
                viewMode.querySelector('.responsible-text').textContent = newValue;
                break;
            case 'section_name':
                viewMode.querySelector('.section-badge').textContent = newValue;
                break;
            case 'status':
                const statusLabels = {
                    'pendiente': 'Pendiente',
                    'en_proceso': 'En Proceso',
                    'completado': 'Completado'
                };
                const statusClasses = {
                    'pendiente': 'warning',
                    'en_proceso': 'info',
                    'completado': 'success'
                };
                const badge = viewMode.querySelector('.status-badge');
                badge.textContent = statusLabels[newValue] || newValue;
                badge.className = `badge bg-${statusClasses[newValue] || 'secondary'} status-badge`;
                break;
            case 'due_date':
                const dateText = viewMode.querySelector('.due-date-text') || viewMode.querySelector('span');
                if (newValue) {
                    const date = new Date(newValue);
                    const formatted = date.toLocaleDateString('es-ES');
                    dateText.textContent = formatted;
                    dateText.classList.remove('text-muted');
                } else {
                    dateText.textContent = 'Sin fecha';
                    dateText.classList.add('text-muted');
                }
                break;
        }
    }
    
    // Save button in edit mode
    document.querySelectorAll('.save-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, true);
        });
    });
    
    // Cancel button in edit mode
    document.querySelectorAll('.cancel-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const cell = this.closest('.editable-cell');
            exitEditMode(cell, false);
        });
    });
    
    // ESC to cancel, Enter to save (for inputs)
    document.querySelectorAll('.edit-mode input, .edit-mode textarea').forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const cell = this.closest('.editable-cell');
                exitEditMode(cell, false);
            } else if (e.key === 'Enter' && input.tagName !== 'TEXTAREA') {
                e.preventDefault();
                const cell = this.closest('.editable-cell');
                exitEditMode(cell, true);
            }
        });
    });
    
    // ==================== SAVE ALL CHANGES ====================
    
    document.getElementById('saveAllBtn').addEventListener('click', async function() {
        if (changedItems.size === 0) {
            showNotification('No hay cambios pendientes para guardar.', 'info');
            return;
        }
        
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Guardando...';
        
        let successCount = 0;
        let errorCount = 0;
        
        for (const [itemId, changes] of changedItems.entries()) {
            try {
                const response = await fetch(`/dashboard/execution/action-plans/items/${itemId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(changes)
                });
                
                if (response.ok) {
                    successCount++;
                    const row = document.querySelector(`tr[data-item-id="${itemId}"]`);
                    row.classList.remove('changed');
                } else {
                    errorCount++;
                    console.error(`Error updating item ${itemId}:`, await response.text());
                }
            } catch (error) {
                errorCount++;
                console.error(`Error updating item ${itemId}:`, error);
            }
        }
        
        changedItems.clear();
        
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-save me-1"></i> Guardar Cambios';
        
        if (errorCount === 0) {
            showNotification(`${successCount} item(s) actualizado(s) exitosamente.`, 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification(`${successCount} item(s) actualizado(s), ${errorCount} error(es).`, 'warning');
        }
    });
    
    // ==================== FILTERS ====================
    
    const searchInput = document.getElementById('searchInput');
    const filterSection = document.getElementById('filterSection');
    const filterStatus = document.getElementById('filterStatus');
    const filterResponsible = document.getElementById('filterResponsible');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const sectionFilter = filterSection.value;
        const statusFilter = filterStatus.value;
        const responsibleFilter = filterResponsible.value;
        
        const rows = document.querySelectorAll('#actionItemsTable tbody .item-row');
        
        rows.forEach(row => {
            const description = row.querySelector('.description-text')?.textContent.toLowerCase() || '';
            const section = row.querySelector('.section-badge')?.textContent.trim() || '';
            const status = row.querySelector('.edit-mode select')?.value || '';
            const responsible = row.querySelector('.responsible-text')?.textContent.trim() || '';
            
            const matchesSearch = !searchTerm || description.includes(searchTerm);
            const matchesSection = !sectionFilter || section === sectionFilter;
            const matchesStatus = !statusFilter || status === statusFilter;
            const matchesResponsible = !responsibleFilter || responsible === responsibleFilter;
            
            if (matchesSearch && matchesSection && matchesStatus && matchesResponsible) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', applyFilters);
    filterSection.addEventListener('change', applyFilters);
    filterStatus.addEventListener('change', applyFilters);
    filterResponsible.addEventListener('change', applyFilters);
    
    clearFiltersBtn.addEventListener('click', function() {
        searchInput.value = '';
        filterSection.value = '';
        filterStatus.value = '';
        filterResponsible.value = '';
        applyFilters();
    });
    
    // ==================== FILE UPLOAD ====================
    
    const uploadModal = new bootstrap.Modal(document.getElementById('uploadFileModal'));
    
    document.querySelectorAll('.upload-file-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            document.getElementById('uploadItemId').value = itemId;
            uploadModal.show();
        });
    });
    
    document.getElementById('uploadFileForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const itemId = document.getElementById('uploadItemId').value;
        
        try {
            const response = await fetch(`/dashboard/execution/action-plans/items/${itemId}/upload-file`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            
            if (response.ok) {
                showNotification('Archivo subido exitosamente.', 'success');
                uploadModal.hide();
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification('Error al subir el archivo.', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Error al subir el archivo.', 'error');
        }
    });
    
    // ==================== FILE DELETE ====================
    
    document.querySelectorAll('.delete-file-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('¿Estás seguro de eliminar este archivo?')) return;
            
            const itemId = this.dataset.itemId;
            
            try {
                const response = await fetch(`/dashboard/execution/action-plans/items/${itemId}/file`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });
                
                if (response.ok) {
                    showNotification('Archivo eliminado exitosamente.', 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification('Error al eliminar el archivo.', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error al eliminar el archivo.', 'error');
            }
        });
    });
    
    // ==================== HELPER FUNCTIONS ====================
    
    function showNotification(message, type = 'info') {
        // Simple toast notification
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
        toast.style.zIndex = 9999;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
</script>
@endpush
@endsection

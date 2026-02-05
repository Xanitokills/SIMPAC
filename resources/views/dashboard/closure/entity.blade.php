@extends('layouts.dashboard')

@section('page-title', 'Gestión de Cierre')
@section('page-description', 'Registrar documentos de cierre de transferencia')

@section('content')

<div class="space-y-6">
    <!-- Botón Regresar -->
    <div class="mb-2">
        <a href="{{ route('dashboard.closure') }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    @php
        // Datos de ejemplo - En producción vendrían del controlador
        $entity = (object)[
            'id' => 1,
            'name' => 'Ministerio de Economía y Finanzas',
            'code' => 'MEF'
        ];

        $closureDocuments = collect([
            (object)[
                'id' => 1,
                'type' => 'informe_cierre',
                'title' => '1. Informe de Cierre',
                'subject' => 'Informe de cierre del proceso de transferencia',
                'date' => '2026-02-01',
                'status' => 'completado',
                'attachments' => [
                    (object)['name' => 'informe_cierre_mef.pdf', 'size' => '2.5 MB'],
                    (object)['name' => 'anexos_informe.pdf', 'size' => '1.2 MB']
                ]
            ],
            (object)[
                'id' => 2,
                'type' => 'sesion_colegiado',
                'title' => '2. Sesión Colegiado',
                'subject' => null,
                'date' => null,
                'status' => 'pendiente',
                'attachments' => []
            ],
            (object)[
                'id' => 3,
                'type' => 'acta_cierre_final',
                'title' => '3. Acta de Cierre Final',
                'subject' => null,
                'date' => null,
                'status' => 'pendiente',
                'attachments' => []
            ],
        ]);
    @endphp

    <!-- Header con información de la entidad -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-lg shadow-lg text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">{{ $entity->name }}</h1>
                    <p class="text-purple-100 mt-1">Código: {{ $entity->code }}</p>
                </div>
                <div class="text-right">
                    <div class="bg-white/20 rounded-lg px-4 py-2">
                        <div class="text-sm text-purple-100">Avance de Cierre</div>
                        <div class="text-2xl font-bold">33%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documentos de Cierre -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Documentos de Cierre</h3>
                <p class="text-sm text-gray-500 mt-1">Registre y gestione los documentos requeridos para el cierre de la transferencia</p>
            </div>

            <div class="space-y-4">
                @foreach($closureDocuments as $doc)
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-2">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $doc->title }}</h4>
                                @if($doc->status === 'completado')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Completado
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        Pendiente
                                    </span>
                                @endif
                            </div>
                            
                            @if($doc->subject)
                                <p class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Asunto:</span> {{ $doc->subject }}
                                </p>
                            @endif
                            
                            @if($doc->date)
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Fecha:</span> {{ \Carbon\Carbon::parse($doc->date)->format('d/m/Y') }}
                                </p>
                            @endif

                            <!-- Archivos adjuntos -->
                            @if(count($doc->attachments) > 0)
                                <div class="mt-4">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Archivos Adjuntos:</p>
                                    <div class="space-y-2">
                                        @foreach($doc->attachments as $attachment)
                                        <div class="flex items-center justify-between bg-white rounded-lg border border-gray-200 p-3">
                                            <div class="flex items-center space-x-3">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ $attachment->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $attachment->size }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                    Descargar
                                                </a>
                                                <button class="text-red-600 hover:text-red-700 text-sm font-medium">
                                                    Eliminar
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <button onclick="openDocumentModal('{{ $doc->type }}', '{{ $doc->title }}', {{ $doc->id }})" 
                                class="ml-4 {{ $doc->status === 'completado' ? 'bg-purple-600 hover:bg-purple-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium py-2 px-4 rounded-lg transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($doc->status === 'completado')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                @endif
                            </svg>
                            <span>{{ $doc->status === 'completado' ? 'Editar' : 'Registrar' }}</span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal para Registrar/Editar Documento -->
<div id="documentModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
        <form id="documentForm" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="p-6">
                <h3 id="modalTitle" class="text-xl font-semibold text-gray-800 mb-4">Registrar Documento</h3>
                
                <div class="space-y-4">
                    <!-- Asunto -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Asunto <span class="text-red-500">*</span>
                        </label>
                        <textarea name="subject" 
                                  id="documentSubject"
                                  rows="2"
                                  placeholder="Describa el asunto del documento..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                                  required></textarea>
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               name="date" 
                               id="documentDate"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"
                               required>
                    </div>

                    <!-- Archivos Adjuntos -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Archivos Adjuntos
                        </label>
                        <input type="file" 
                               name="attachments[]"
                               multiple
                               accept=".pdf,.doc,.docx,.xls,.xlsx"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                        <p class="text-xs text-gray-500 mt-1">Puede subir varios archivos. Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX</p>
                    </div>

                    <!-- Comentarios adicionales -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Comentarios Adicionales
                        </label>
                        <textarea name="comments" 
                                  id="documentComments"
                                  rows="3"
                                  placeholder="Comentarios adicionales (opcional)..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 px-6 py-4 bg-gray-50 rounded-b-lg">
                <button type="button" 
                        onclick="closeDocumentModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    Cancelar
                </button>
                <button type="submit" 
                        class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Guardar Documento
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDocumentModal(type, title, id) {
    const modal = document.getElementById('documentModal');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('documentForm');
    
    modalTitle.textContent = 'Registrar ' + title;
    form.action = `/dashboard/closure/documents/${id}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDocumentModal() {
    const modal = document.getElementById('documentModal');
    const form = document.getElementById('documentForm');
    
    form.reset();
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Cerrar modal al hacer clic fuera
document.getElementById('documentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDocumentModal();
    }
});
</script>

@endsection

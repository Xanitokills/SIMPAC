@extends('layouts.dashboard')

@section('page-title', 'Crear Notificación de Seguimiento')
@section('page-description', 'Notificación por falta de respuesta y registro de evidencia')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Nueva Notificación de Seguimiento</h2>
            <p class="text-sm text-gray-500 mt-1">Registre la notificación enviada por falta de respuesta y adjunte evidencias</p>
        </div>

        <form action="{{ route('execution.notifications.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="space-y-6">
                @if(isset($assignment) && $assignment)
                    <!-- Asignación Pre-seleccionada (desde entity panel) -->
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-red-900">Notificación para:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <p class="font-semibold">{{ $assignment->entity->name }}</p>
                                    <p class="text-xs mt-1">Sectorista: {{ $assignment->sectorista->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Seleccionar Oficio/Solicitud Original -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Oficio o Solicitud Original <span class="text-red-500">*</span>
                    </label>
                    <select name="oficio_id" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            id="oficioSelect">
                        <option value="">Seleccione el oficio o solicitud...</option>
                        @foreach($oficios as $oficio)
                            <option value="{{ $oficio->id }}" 
                                    data-entity="{{ $oficio->entityAssignment->entity->name }}"
                                    data-number="{{ $oficio->numero_oficio }}"
                                    data-date="{{ $oficio->fecha_envio->format('d/m/Y') }}">
                                {{ $oficio->numero_oficio }} - {{ $oficio->entityAssignment->entity->name }} 
                                ({{ $oficio->fecha_envio->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('oficio_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if(isset($assignment) && $assignment)
                        <p class="text-xs text-gray-500 mt-1">
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mostrando solo oficios de {{ $assignment->entity->name }}
                        </p>
                    @endif
                </div>

                <!-- Tipo de Notificación -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Notificación <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-yellow-500 transition-colors">
                            <input type="radio" name="notification_type" value="reminder" required
                                   class="sr-only peer">
                            <div class="flex-1 peer-checked:text-yellow-700">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <span class="font-semibold">Recordatorio</span>
                                </div>
                                <p class="text-xs text-gray-500">Primera notificación amigable</p>
                            </div>
                            <div class="absolute inset-0 border-2 border-yellow-500 rounded-lg opacity-0 peer-checked:opacity-100"></div>
                        </label>

                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-orange-500 transition-colors">
                            <input type="radio" name="notification_type" value="escalation" required
                                   class="sr-only peer">
                            <div class="flex-1 peer-checked:text-orange-700">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span class="font-semibold">Escalamiento</span>
                                </div>
                                <p class="text-xs text-gray-500">Notificación más formal</p>
                            </div>
                            <div class="absolute inset-0 border-2 border-orange-500 rounded-lg opacity-0 peer-checked:opacity-100"></div>
                        </label>

                        <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-red-500 transition-colors">
                            <input type="radio" name="notification_type" value="final_notice" required
                                   class="sr-only peer">
                            <div class="flex-1 peer-checked:text-red-700">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="font-semibold">Aviso Final</span>
                                </div>
                                <p class="text-xs text-gray-500">Última notificación oficial</p>
                            </div>
                            <div class="absolute inset-0 border-2 border-red-500 rounded-lg opacity-0 peer-checked:opacity-100"></div>
                        </label>
                    </div>
                    @error('notification_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Notificación -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Envío de la Notificación <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="notification_date" required
                           value="{{ old('notification_date', now()->format('Y-m-d')) }}"
                           max="{{ now()->format('Y-m-d') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    @error('notification_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mensaje de Notificación -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Contenido de la Notificación <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" rows="6" required
                              placeholder="Describa el contenido de la notificación enviada a la entidad..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Incluya detalles sobre el motivo de la notificación y las acciones esperadas</p>
                </div>

                <!-- Evidencias -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Evidencias de la Notificación</h3>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-blue-900">¿Qué evidencias debo adjuntar?</p>
                                <ul class="text-xs text-blue-700 mt-2 space-y-1 list-disc list-inside">
                                    <li>Captura de pantalla del correo enviado</li>
                                    <li>Comprobante de envío postal o mensajería</li>
                                    <li>Confirmación de recepción (si aplica)</li>
                                    <li>Cualquier otro documento que pruebe el envío</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Adjuntar Evidencias <span class="text-gray-500">(Múltiples archivos permitidos)</span>
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Clic para subir</span> o arrastra archivos</p>
                                    <p class="text-xs text-gray-500">PDF, JPG, PNG, DOC, DOCX (MAX. 10MB c/u)</p>
                                </div>
                                <input type="file" name="evidence_documents[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="hidden" id="fileInput">
                            </label>
                        </div>
                        <div id="fileList" class="mt-3 space-y-2"></div>
                        @error('evidence_documents.*')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="evidence_required" value="1"
                                   class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            <span class="text-sm text-gray-700">Marcar como notificación con evidencia requerida obligatoriamente</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard.execution') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>Registrar Notificación</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    fileInput.addEventListener('change', function(e) {
        fileList.innerHTML = '';
        
        if (this.files.length > 0) {
            Array.from(this.files).forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg';
                fileItem.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">${file.name}</p>
                            <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                        </div>
                    </div>
                    <button type="button" onclick="removeFile(${index})" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        }
    });
});

function removeFile(index) {
    const fileInput = document.getElementById('fileInput');
    const dt = new DataTransfer();
    const files = Array.from(fileInput.files);
    
    files.forEach((file, i) => {
        if (i !== index) dt.items.add(file);
    });
    
    fileInput.files = dt.files;
    fileInput.dispatchEvent(new Event('change'));
}
</script>
@endsection

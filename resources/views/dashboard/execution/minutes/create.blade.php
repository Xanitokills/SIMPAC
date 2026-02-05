@extends('layouts.dashboard')

@section('page-title', 'Registrar Acta de Reunión')
@section('page-description', 'Registrar acta de reunión por componente')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <a href="{{ route('execution.entity', $assignment->id) }}" class="mr-4 p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-colors" title="Regresar">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h2 class="text-xl font-semibold">Registrar Acta de Reunión</h2>
                    <p class="text-sm text-gray-500">Entidad: {{ $assignment->entity->name }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('execution.minutes.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Número de Acta</label>
                <input type="text" name="minute_number" value="{{ old('minute_number') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Componente</label>
                    <select name="component" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="">-- Seleccionar --</option>
                        <option value="recursos_presupuestarios">Recursos Presupuestarios</option>
                        <option value="recursos_humanos">Recursos Humanos</option>
                        <option value="bienes_servicios">Bienes y Servicios</option>
                        <option value="acervo_documentario">Acervo Documentario</option>
                        <option value="activos_informaticos">Activos Informáticos</option>
                        <option value="instalacion_componentes">Instalación de Componentes</option>
                        <option value="cierre_transferencia">Cierre de transferencia</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Asunto</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="proceso_de_firmas">Proceso de firmas</option>
                    <option value="proceso_de_firmas_pge">Proceso de firmas PGE</option>
                    <option value="falta_de_firma">Falta de firma</option>
                    <option value="firmado">Firmado</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Archivo PDF del Acta (opcional)</label>
                <input type="file" name="pdf" accept="application/pdf" class="mt-1 block w-full">
            </div>

            <div class="flex items-center justify-end space-x-3 mt-4">
                <a href="{{ route('execution.entity', $assignment->id) }}" class="px-4 py-2 border rounded">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Guardar Acta</button>
            </div>
        </form>
    </div>
</div>
@endsection

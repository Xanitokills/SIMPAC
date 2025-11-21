@extends('layouts.dashboard')

@section('page-title', 'Editar Asignación')
@section('page-description', $assignment->entity->name)

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="mb-4 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('activity2.index') }}" class="hover:text-blue-600">Actividad 2</a></li>
            <li>/</li>
            <li><a href="{{ route('activity2.show', $assignment->id) }}" class="hover:text-blue-600">{{ $assignment->entity->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Editar</li>
        </ol>
    </nav>

    <!-- Formulario de Edición -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Editar Asignación</h1>
            <p class="mt-1 text-sm text-gray-600">Actualizar información de la asignación de la entidad</p>
        </div>

        <!-- Información de la Entidad (No editable) -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $assignment->entity->name }}</h2>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                    {{ $assignment->entity->type }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $assignment->entity->sector }}
                </span>
            </div>
            <p class="mt-2 text-sm text-gray-600">Sectorista: <span class="font-semibold">{{ $assignment->sectorista->name }}</span></p>
        </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('activity2.update', $assignment->id) }}">
            @csrf
            @method('PUT')

            <!-- Estado -->
            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Estado de la Asignación
                </label>
                <select id="status" name="status" required
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="pending" {{ $assignment->status === 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="active" {{ $assignment->status === 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="in_progress" {{ $assignment->status === 'in_progress' ? 'selected' : '' }}>En Progreso</option>
                    <option value="completed" {{ $assignment->status === 'completed' ? 'selected' : '' }}>Completado</option>
                    <option value="cancelled" {{ $assignment->status === 'cancelled' ? 'selected' : '' }}>Cancelado</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prioridad -->
            <div class="mb-6">
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                    Prioridad (Opcional)
                </label>
                <select id="priority" name="priority"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Sin prioridad específica</option>
                    <option value="low" {{ $assignment->priority === 'low' ? 'selected' : '' }}>Baja</option>
                    <option value="medium" {{ $assignment->priority === 'medium' ? 'selected' : '' }}>Media</option>
                    <option value="high" {{ $assignment->priority === 'high' ? 'selected' : '' }}>Alta</option>
                    <option value="urgent" {{ $assignment->priority === 'urgent' ? 'selected' : '' }}>Urgente</option>
                </select>
                @error('priority')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notas -->
            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notas (Opcional)
                </label>
                <textarea id="notes" name="notes" rows="4"
                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                          placeholder="Agregar notas o comentarios sobre esta asignación...">{{ old('notes', $assignment->notes) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Máximo 1000 caracteres</p>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('activity2.show', $assignment->id) }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

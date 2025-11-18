@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('execution.meetings.show', $meeting->id) }}" 
           class="text-blue-600 hover:text-blue-800 mb-2 inline-block">
            ← Volver a Detalles de Reunión
        </a>
        <h1 class="text-3xl font-bold text-gray-800">
            Editar Reunión de Coordinación
        </h1>
        <p class="text-gray-600 mt-2">
            {{ $meeting->entityAssignment->entity->name }}
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('execution.meetings.update', $meeting->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Meeting Type -->
            <div class="mb-6">
                <label for="meeting_type" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tipo de Reunión <span class="text-red-500">*</span>
                </label>
                <select name="meeting_type" id="meeting_type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Seleccione un tipo</option>
                    <option value="coordination" {{ old('meeting_type', $meeting->meeting_type) === 'coordination' ? 'selected' : '' }}>
                        Reunión de Coordinación
                    </option>
                    <option value="presentation" {{ old('meeting_type', $meeting->meeting_type) === 'presentation' ? 'selected' : '' }}>
                        Presentación de Propuesta
                    </option>
                    <option value="follow_up" {{ old('meeting_type', $meeting->meeting_type) === 'follow_up' ? 'selected' : '' }}>
                        Seguimiento
                    </option>
                </select>
                @error('meeting_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Título de la Reunión <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" required
                       value="{{ old('subject', $meeting->subject) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Ej: Primera reunión de coordinación con la entidad">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Descripción / Agenda
                </label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Describa los temas a tratar en la reunión...">{{ old('description', $meeting->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meeting Date and Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="meeting_date" class="block text-sm font-semibold text-gray-700 mb-2">
                        Fecha de la Reunión <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="meeting_date" id="meeting_date" required
                           value="{{ old('meeting_date', \Carbon\Carbon::parse($meeting->meeting_date)->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('meeting_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meeting_time" class="block text-sm font-semibold text-gray-700 mb-2">
                        Hora de la Reunión <span class="text-red-500">*</span>
                    </label>
                    <input type="time" name="meeting_time" id="meeting_time" required
                           value="{{ old('meeting_time', \Carbon\Carbon::parse($meeting->meeting_date)->format('H:i')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('meeting_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Location -->
            <div class="mb-6">
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                    Ubicación / Modalidad
                </label>
                <input type="text" name="location" id="location"
                       value="{{ old('location', $meeting->location) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Ej: Oficinas de la entidad / Virtual vía Zoom">
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Participants -->
            <div class="mb-6">
                <label for="participants" class="block text-sm font-semibold text-gray-700 mb-2">
                    Participantes
                </label>
                <textarea name="participants" id="participants" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Liste los participantes de la reunión...">{{ old('participants', $meeting->participants) }}</textarea>
                @error('participants')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Outcome (if meeting is completed) -->
            @if($meeting->status === 'completed')
            <div class="mb-6">
                <label for="outcome" class="block text-sm font-semibold text-gray-700 mb-2">
                    Resultado de la Reunión
                </label>
                <textarea name="outcome" id="outcome" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Describa los resultados y conclusiones de la reunión...">{{ old('outcome', $meeting->outcome) }}</textarea>
                @error('outcome')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('execution.meetings.show', $meeting->id) }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg font-semibold">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

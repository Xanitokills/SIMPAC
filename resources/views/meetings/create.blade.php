@extends('layouts.dashboard')

@section('page-title', 'Programar Reunión')
@section('page-description', 'Coordinar reunión con ' . $assignment->entity->name)

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="mb-4 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('activity2.index') }}" class="hover:text-blue-600">Actividad 2</a></li>
            <li>/</li>
            <li><a href="{{ route('activity2.show', $assignment->id) }}" class="hover:text-blue-600">{{ $assignment->entity->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Programar Reunión</li>
        </ol>
    </nav>

    <!-- Información de la Entidad -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Programar Reunión</h1>
                <p class="text-sm text-gray-600 mt-1">
                    Entidad: <span class="font-semibold">{{ $assignment->entity->name }}</span>
                </p>
                <p class="text-sm text-gray-600">
                    Sectorista: <span class="font-semibold">{{ $assignment->sectorista->name }}</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form method="POST" action="{{ route('meetings.store', $assignment->id) }}">
            @csrf

            <!-- Información de Contacto -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Información de Contacto
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del Contacto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="contact_name" name="contact_name" required
                               value="{{ old('contact_name') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Nombre completo">
                        @error('contact_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email
                        </label>
                        <input type="email" id="contact_email" name="contact_email"
                               value="{{ old('contact_email') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="correo@ejemplo.com">
                        @error('contact_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Teléfono
                        </label>
                        <input type="tel" id="contact_phone" name="contact_phone"
                               value="{{ old('contact_phone') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="999 999 999">
                        @error('contact_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Detalles de la Reunión -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Detalles de la Reunión
                </h3>

                <div class="space-y-4">
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                            Asunto <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="subject" name="subject" required
                               value="{{ old('subject', 'Coordinación - Conformación Órgano Colegiado') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Tema de la reunión">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="scheduled_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha y Hora <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" id="scheduled_date" name="scheduled_date" required
                                   value="{{ old('scheduled_date') }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('scheduled_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="meeting_type" class="block text-sm font-medium text-gray-700 mb-1">
                                Tipo de Reunión <span class="text-red-500">*</span>
                            </label>
                            <select id="meeting_type" name="meeting_type" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Seleccionar...</option>
                                <option value="virtual" {{ old('meeting_type') === 'virtual' ? 'selected' : '' }}>Virtual</option>
                                <option value="presencial" {{ old('meeting_type') === 'presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="hibrida" {{ old('meeting_type') === 'hibrida' ? 'selected' : '' }}>Híbrida</option>
                            </select>
                            @error('meeting_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                            Ubicación / Enlace
                        </label>
                        <input type="text" id="location" name="location"
                               value="{{ old('location') }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Dirección o enlace de videollamada">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Notas / Agenda
                        </label>
                        <textarea id="notes" name="notes" rows="4"
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                  placeholder="Temas a tratar, preparativos necesarios, etc.">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="{{ route('activity2.show', $assignment->id) }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Programar Reunión
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

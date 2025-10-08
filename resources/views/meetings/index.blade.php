@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Breadcrumb -->
    <nav class="mb-4 text-sm">
        <ol class="flex items-center space-x-2 text-gray-600">
            <li><a href="{{ route('activity2.index') }}" class="hover:text-blue-600">Actividad 2</a></li>
            <li>/</li>
            <li><a href="{{ route('activity2.show', $assignment->id) }}" class="hover:text-blue-600">{{ $assignment->entity->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900 font-medium">Reuniones</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Reuniones</h1>
                <p class="mt-2 text-gray-600">Entidad: <span class="font-semibold">{{ $assignment->entity->name }}</span></p>
            </div>
            <a href="{{ route('meetings.create', $assignment->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Reunión
            </a>
        </div>
    </div>

    <!-- Listado de Reuniones -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        @if($meetings->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asunto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contacto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acuerdos
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($meetings as $meeting)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $meeting->subject }}</div>
                                    @if($meeting->meeting_link)
                                        <a href="{{ $meeting->meeting_link }}" target="_blank" 
                                           class="text-xs text-blue-600 hover:text-blue-800">
                                            Ver enlace
                                        </a>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $meeting->contact_name }}</div>
                                    @if($meeting->contact_email)
                                        <div class="text-xs text-gray-500">{{ $meeting->contact_email }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $meeting->scheduled_date->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $meeting->scheduled_date->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'scheduled' => 'bg-blue-100 text-blue-800',
                                            'rescheduled' => 'bg-yellow-100 text-yellow-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$meeting->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-800 text-sm font-medium">
                                        {{ $meeting->agreements->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('meetings.show', $meeting->id) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            Ver
                                        </a>
                                        @if($meeting->status !== 'completed')
                                            <a href="{{ route('meetings.edit', $meeting->id) }}" 
                                               class="text-yellow-600 hover:text-yellow-900">
                                                Editar
                                            </a>
                                        @endif
                                        <a href="{{ route('meetings.history', $meeting->id) }}" 
                                           class="text-gray-600 hover:text-gray-900">
                                            Historial
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $meetings->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay reuniones</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza programando una reunión con la entidad.</p>
                <div class="mt-6">
                    <a href="{{ route('meetings.create', $assignment->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Programar Reunión
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

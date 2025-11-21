@extends('layouts.dashboard')

@section('page-title', 'Oficios')
@section('page-description', 'Lista de oficios enviados a la entidad')

@section('breadcrumb')
    <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors" title="Inicio">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
    </a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <a href="{{ route('activity2.show', $assignment->id) }}" class="hover:text-blue-600 transition-colors">{{ $assignment->entity->name }}</a>
    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    <span class="text-gray-700 font-medium">Oficios</span>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Botón Regresar -->
    <div class="mb-4">
        <a href="{{ route('activity2.show', $assignment->id) }}" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Regresar</span>
        </a>
    </div>

    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg text-white p-6 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="p-3 bg-white bg-opacity-20 rounded-lg mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Oficios Enviados</h1>
                    <p class="text-yellow-100 mt-1">{{ $assignment->entity->name }}</p>
                </div>
            </div>
            <a href="{{ route('oficios.create', $assignment->id) }}" 
               class="bg-white text-yellow-600 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-50 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nuevo Oficio
            </a>
        </div>
    </div>

    <!-- Mensajes Flash -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Lista de Oficios -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($oficios->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asunto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Emisión</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Límite</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($oficios as $oficio)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $oficio->oficio_number ?? 'Sin número' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($oficio->type == 'solicitud')
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                                            Solicitud
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-700 rounded-full">
                                            Reiteración
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900">{{ Str::limit($oficio->subject, 50) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $oficio->issue_date ? $oficio->issue_date->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $oficio->deadline_date ? $oficio->deadline_date->format('d/m/Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($oficio->status)
                                        @case('pendiente')
                                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-700 rounded-full">
                                                Pendiente
                                            </span>
                                            @break
                                        @case('respondido')
                                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                                                Respondido
                                            </span>
                                            @break
                                        @case('vencido')
                                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">
                                                Vencido
                                            </span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full">
                                                {{ ucfirst($oficio->status) }}
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('oficios.show', $oficio->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $oficios->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay oficios registrados</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza cargando un documento enviado.</p>
                <div class="mt-6">
                    <a href="{{ route('oficios.create', $assignment->id) }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Cargar Documento
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

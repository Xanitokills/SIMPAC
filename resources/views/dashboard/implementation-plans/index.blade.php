@extends('layouts.dashboard')

@section('page-title', 'Planes de Implementación PGE')
@section('page-description', 'Gestión de Planes de Implementación de la Presidencia de la Gestión Económica')

@section('content')
<div class="space-y-6">
    <!-- Mensajes de éxito o error -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <p class="text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <p class="text-red-700 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Plan Activo -->
    @if($activePlan)
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg text-white">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-semibold uppercase tracking-wider">Plan Activo</span>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">{{ $activePlan->plan_name }}</h2>
                    <p class="text-green-100 mb-4">{{ $activePlan->description }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <p class="text-xs text-green-100 mb-1">Tipo de Resolución</p>
                            <p class="font-semibold">{{ $activePlan->resolution_type }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <p class="text-xs text-green-100 mb-1">Número de Resolución</p>
                            <p class="font-semibold">{{ $activePlan->resolution_number }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <p class="text-xs text-green-100 mb-1">Fecha de Inicio</p>
                            <p class="font-semibold">{{ $activePlan->start_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-lg p-3">
                            <p class="text-xs text-green-100 mb-1">Estado</p>
                            <p class="font-semibold">Vigente</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex space-x-3 mt-6">
                <a href="{{ route('implementation-plans.show', $activePlan) }}" class="px-4 py-2 bg-white text-green-600 rounded-lg hover:bg-green-50 transition-colors font-medium">
                    Ver Detalles
                </a>
                <a href="{{ Storage::url($activePlan->pdf_path) }}" target="_blank" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition-colors">
                    📄 Descargar Plan PDF
                </a>
                @if($activePlan->resolution_pdf_path)
                <a href="{{ Storage::url($activePlan->resolution_pdf_path) }}" target="_blank" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors">
                    📋 Descargar Resolución
                </a>
                @endif
                <form action="{{ route('implementation-plans.close', $activePlan) }}" method="POST" onsubmit="return confirm('¿Está seguro de cerrar este plan? Esto permitirá crear un nuevo plan.')">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Cerrar Plan
                    </button>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-yellow-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div class="flex-1">
                <h3 class="text-yellow-800 font-semibold">No hay Plan de Implementación activo</h3>
                <p class="text-yellow-700 text-sm mt-1">Debe registrar un Plan de Implementación para poder iniciar el proceso de transferencia.</p>
                <a href="{{ route('implementation-plans.create') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Registrar Nuevo Plan
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Botones de acción -->
    <div class="flex justify-end gap-3">
        @if($activePlan)
        <a href="{{ route('entity-assignments.index', ['plan_id' => $activePlan->id]) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            Gestionar Asignaciones
        </a>
        @else
        <a href="{{ route('implementation-plans.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Registrar Plan de Implementación
        </a>
        @endif
    </div>

    <!-- Historial de Planes -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Historial de Planes de Implementación</h3>
            <p class="text-sm text-gray-600 mt-1">Registro completo de todos los planes registrados en el sistema</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del Plan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Año</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vigencia</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($plans as $plan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">
                                {{ $plan->resolution_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $plan->resolution_number }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $plan->plan_name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($plan->description, 40) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $plan->year }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-xs text-gray-600">
                                <div>{{ $plan->start_date->format('d/m/Y') }}</div>
                                @if($plan->end_date)
                                <div>{{ $plan->end_date->format('d/m/Y') }}</div>
                                @else
                                <div class="text-green-600 font-medium">Vigente</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($plan->status === 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Activo
                                </span>
                            @elseif($plan->status === 'expired')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Expirado
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Modificado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('implementation-plans.show', $plan) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                                <a href="{{ Storage::url($plan->pdf_path) }}" target="_blank" class="text-green-600 hover:text-green-900">PDF</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="mt-2 text-sm">No hay planes de implementación registrados.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($plans->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $plans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('page-title', 'Detalle del Plan de Implementación')
@section('page-description', 'Información completa del Plan de Implementación PGE')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Mensajes -->
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

    <!-- Encabezado con estado -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3 mb-3">
                        @if($implementationPlan->status === 'active')
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                ✓ Activo
                            </span>
                        @elseif($implementationPlan->status === 'expired')
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-semibold rounded-full">
                                Expirado
                            </span>
                        @else
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">
                                Modificado
                            </span>
                        @endif
                        <span class="text-sm text-gray-500">{{ $implementationPlan->resolution_type }}-{{ $implementationPlan->resolution_number }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $implementationPlan->name }}</h1>
                    @if($implementationPlan->description)
                    <p class="text-gray-600">{{ $implementationPlan->description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Información principal -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Datos del Plan -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Información del Plan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Tipo de Resolución</dt>
                    <dd class="text-base text-gray-900 font-medium">{{ $implementationPlan->resolution_type }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Número de Resolución</dt>
                    <dd class="text-base text-gray-900 font-medium">{{ $implementationPlan->resolution_number }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Fecha de Inicio de Vigencia</dt>
                    <dd class="text-base text-gray-900">{{ $implementationPlan->start_date->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Fecha de Fin de Vigencia</dt>
                    <dd class="text-base text-gray-900">
                        @if($implementationPlan->end_date)
                            {{ $implementationPlan->end_date->format('d/m/Y') }}
                        @else
                            <span class="text-green-600 font-medium">Vigente</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Estado</dt>
                    <dd class="text-base text-gray-900">
                        @if($implementationPlan->status === 'active')
                            <span class="text-green-600 font-medium">Activo</span>
                        @elseif($implementationPlan->status === 'expired')
                            <span class="text-gray-600">Expirado</span>
                        @else
                            <span class="text-blue-600">Modificado</span>
                        @endif
                    </dd>
                </div>
            </div>
        </div>

        <!-- Información de aprobación -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Información de Registro</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Registrado por</dt>
                    <dd class="text-base text-gray-900">
                        {{ $implementationPlan->approvedBy->name ?? 'Sistema' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Fecha de Registro</dt>
                    <dd class="text-base text-gray-900">
                        {{ $implementationPlan->approved_at ? $implementationPlan->approved_at->format('d/m/Y H:i') : '—' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-1">Última actualización</dt>
                    <dd class="text-base text-gray-900">{{ $implementationPlan->updated_at->format('d/m/Y H:i') }}</dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Documento PDF -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Documento del Plan</h3>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-10 h-10 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="font-medium text-gray-900">Plan de Implementación PGE</p>
                        <p class="text-sm text-gray-500">Documento PDF</p>
                    </div>
                </div>
                <a href="{{ Storage::url($implementationPlan->pdf_path) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Descargar PDF
                </a>
            </div>
        </div>
    </div>

    <!-- Gestión de Asignaciones -->
    @if($implementationPlan->status === 'active')
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg shadow-sm border-2 border-blue-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900">Asignación de Entidades</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Configure las asignaciones de entidades a sectoristas (operarios) para este plan de implementación.
                    </p>
                    <a href="{{ route('entity-assignments.index', ['plan' => $implementationPlan->id]) }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Gestionar Asignaciones
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Acciones -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('implementation-plans.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    ← Volver al listado
                </a>
                
                <div class="flex flex-wrap gap-3">
                    @if($implementationPlan->status === 'active')
                    <a href="{{ route('implementation-plans.edit', $implementationPlan) }}" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Editar
                    </a>
                    <form action="{{ route('implementation-plans.close', $implementationPlan) }}" method="POST" onsubmit="return confirm('¿Está seguro de cerrar este plan? Esto permitirá crear un nuevo plan.')">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                            Cerrar Plan
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

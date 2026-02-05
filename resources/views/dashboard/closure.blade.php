@extends('layouts.dashboard')

@section('page-title', 'Etapa de Cierre')
@section('page-description', 'Fase 3: Cierre y evaluación del proceso de implementación')

@section('content')

<div class="space-y-6">
    <!-- Phase Overview -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-sm text-white">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Fase 3: Etapa de Cierre</h2>
                    <p class="text-purple-100 mt-1">Gestión de documentos de cierre por entidad</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold">0%</div>
                    <div class="text-sm text-purple-100">Completado</div>
                </div>
            </div>
            <div class="mt-4">
                <div class="w-full bg-purple-400 rounded-full h-2">
                    <div class="bg-white h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Entidades Asignadas -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Entidades Asignadas</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestionar documentos de cierre para cada entidad</p>
                </div>
            </div>

            @php
                // Datos de ejemplo - En producción vendrían del controlador
                $assignedEntities = collect([
                    (object)[
                        'id' => 1,
                        'entity_name' => 'Ministerio de Economía y Finanzas',
                        'entity_code' => 'MEF',
                        'closure_progress' => 33,
                        'documents' => [
                            'informe_cierre' => true,
                            'sesion_colegiado' => false,
                            'acta_cierre_final' => false
                        ]
                    ],
                    (object)[
                        'id' => 2,
                        'entity_name' => 'Ministerio de Educación',
                        'entity_code' => 'MINEDU',
                        'closure_progress' => 0,
                        'documents' => [
                            'informe_cierre' => false,
                            'sesion_colegiado' => false,
                            'acta_cierre_final' => false
                        ]
                    ],
                    (object)[
                        'id' => 3,
                        'entity_name' => 'Ministerio de Salud',
                        'entity_code' => 'MINSA',
                        'closure_progress' => 67,
                        'documents' => [
                            'informe_cierre' => true,
                            'sesion_colegiado' => true,
                            'acta_cierre_final' => false
                        ]
                    ],
                ]);
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($assignedEntities as $entity)
                <div class="bg-white rounded-lg border border-gray-200 p-5 hover:shadow-md transition-all">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ $entity->entity_name }}</h4>
                            <p class="text-sm text-gray-500">Código: {{ $entity->entity_code }}</p>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-500">Avance de cierre:</span>
                            <span class="font-semibold text-gray-700">{{ $entity->closure_progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full transition-all" style="width: {{ $entity->closure_progress }}%"></div>
                        </div>
                    </div>

                    <!-- Documents Status -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-xs">
                            @if($entity->documents['informe_cierre'])
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <span class="{{ $entity->documents['informe_cierre'] ? 'text-green-700' : 'text-gray-500' }}">1. Informe de Cierre</span>
                        </div>
                        <div class="flex items-center text-xs">
                            @if($entity->documents['sesion_colegiado'])
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <span class="{{ $entity->documents['sesion_colegiado'] ? 'text-green-700' : 'text-gray-500' }}">2. Sesión Colegiado</span>
                        </div>
                        <div class="flex items-center text-xs">
                            @if($entity->documents['acta_cierre_final'])
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-gray-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                            <span class="{{ $entity->documents['acta_cierre_final'] ? 'text-green-700' : 'text-gray-500' }}">3. Acta de Cierre Final</span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{ route('closure.entity', $entity->id) }}" 
                       class="block w-full bg-purple-600 hover:bg-purple-700 text-white text-center font-medium py-2 px-4 rounded-lg transition-colors">
                        Gestionar Cierre
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

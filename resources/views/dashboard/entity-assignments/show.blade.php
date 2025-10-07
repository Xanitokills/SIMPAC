<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de Asignación') }}
            </h2>
            <div class="flex space-x-2">
                @if($entityAssignment->status === 'active')
                    <a href="{{ route('entity-assignments.edit', $entityAssignment) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Editar
                    </a>
                    <form action="{{ route('entity-assignments.complete', $entityAssignment) }}" 
                          method="POST" class="inline"
                          onsubmit="return confirm('¿Está seguro de finalizar esta asignación?')">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Finalizar
                        </button>
                    </form>
                    <button onclick="showCancelModal()" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        Cancelar
                    </button>
                @endif
                <a href="{{ route('entity-assignments.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Información de la Asignación -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Estado de la Asignación</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Estado:</p>
                            <p class="font-medium">
                                @if($entityAssignment->status === 'active')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                @elseif($entityAssignment->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Finalizada
                                    </span>
                                @elseif($entityAssignment->status === 'cancelled')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        Cancelada
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Fecha de Asignación:</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($entityAssignment->assigned_date)->format('d/m/Y') }}</p>
                        </div>
                        @if($entityAssignment->end_date)
                        <div>
                            <p class="text-sm text-gray-600">Fecha de Finalización:</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($entityAssignment->end_date)->format('d/m/Y') }}</p>
                        </div>
                        @endif
                        @if($entityAssignment->assignedBy)
                        <div>
                            <p class="text-sm text-gray-600">Asignado por:</p>
                            <p class="font-medium">{{ $entityAssignment->assignedBy->name }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Información de la Entidad -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Entidad Asignada</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre:</p>
                            <p class="font-medium">{{ $entityAssignment->entity->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Código:</p>
                            <p class="font-medium">{{ $entityAssignment->entity->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tipo:</p>
                            <p class="font-medium">
                                @if($entityAssignment->entity->type === 'sector')
                                    Sector
                                @elseif($entityAssignment->entity->type === 'institution')
                                    Institución
                                @elseif($entityAssignment->entity->type === 'program')
                                    Programa
                                @else
                                    {{ ucfirst($entityAssignment->entity->type) }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Estado:</p>
                            <p class="font-medium">
                                @if($entityAssignment->entity->status === 'active')
                                    <span class="text-green-600">Activa</span>
                                @else
                                    <span class="text-gray-600">Inactiva</span>
                                @endif
                            </p>
                        </div>
                        @if($entityAssignment->entity->description)
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-600">Descripción:</p>
                            <p class="font-medium">{{ $entityAssignment->entity->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Información del Sectorista -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Sectorista Asignado</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre:</p>
                            <p class="font-medium">{{ $entityAssignment->sectorista->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email:</p>
                            <p class="font-medium">{{ $entityAssignment->sectorista->email }}</p>
                        </div>
                        @if($entityAssignment->sectorista->employee_code)
                        <div>
                            <p class="text-sm text-gray-600">Código de Empleado:</p>
                            <p class="font-medium">{{ $entityAssignment->sectorista->employee_code }}</p>
                        </div>
                        @endif
                        @if($entityAssignment->sectorista->department)
                        <div>
                            <p class="text-sm text-gray-600">Departamento:</p>
                            <p class="font-medium">{{ $entityAssignment->sectorista->department }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-sm text-gray-600">Estado:</p>
                            <p class="font-medium">
                                @if($entityAssignment->sectorista->status === 'active')
                                    <span class="text-green-600">Activo</span>
                                @else
                                    <span class="text-gray-600">Inactivo</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan de Implementación -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Plan de Implementación</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre del Plan:</p>
                            <p class="font-medium">{{ $entityAssignment->implementationPlan->plan_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Resolución:</p>
                            <p class="font-medium">{{ $entityAssignment->implementationPlan->resolution_type }} {{ $entityAssignment->implementationPlan->resolution_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Vigencia:</p>
                            <p class="font-medium">
                                {{ \Carbon\Carbon::parse($entityAssignment->implementationPlan->start_date)->format('d/m/Y') }} - 
                                {{ \Carbon\Carbon::parse($entityAssignment->implementationPlan->end_date)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Año:</p>
                            <p class="font-medium">{{ $entityAssignment->implementationPlan->year }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notas -->
            @if($entityAssignment->notes)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Notas / Observaciones</h3>
                    <div class="prose max-w-none">
                        <p class="whitespace-pre-wrap">{{ $entityAssignment->notes }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal para Cancelar -->
    <div id="cancelModal" class="hidden fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('entity-assignments.cancel', $entityAssignment) }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Cancelar Asignación</h3>
                        <div class="mb-4">
                            <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Motivo de Cancelación *
                            </label>
                            <textarea 
                                name="cancellation_reason" 
                                id="cancellation_reason"
                                rows="4"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ingrese el motivo de la cancelación..."></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" 
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar Asignación
                        </button>
                        <button type="button" 
                                onclick="hideCancelModal()"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showCancelModal() {
            document.getElementById('cancelModal').classList.remove('hidden');
        }

        function hideCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

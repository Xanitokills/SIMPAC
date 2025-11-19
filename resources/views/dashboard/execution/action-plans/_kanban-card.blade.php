{{-- Tarjeta Kanban para un item del plan de acción --}}
@php
    // Usar la misma lógica que el controlador para determinar la sección
    $sectionName = 'Sin sección';
    if (!empty($item->section_name)) {
        $sectionName = $item->section_name;
    } else {
        // Derivar sección del código (ej: "1.1.1" -> "1.1")
        $code = $item->action_name ?? '';
        $parts = explode('.', $code);
        if (count($parts) >= 2) {
            $sectionName = $parts[0] . '.' . $parts[1];
        }
    }
@endphp
<div class="kanban-card bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer"
     data-item-id="{{ $item->id }}"
     data-section="{{ $sectionName }}"
     data-status="{{ $item->status }}"
     data-end-date="{{ $item->end_date ? $item->end_date->format('Y-m-d') : '' }}"
     onclick="openEditModal(
        {{ $item->id }},
        '{{ $item->status }}',
        `{{ addslashes($item->comments ?? '') }}`,
        '{{ $item->predecessor_action ?? '' }}',
        '{{ $item->start_date ? $item->start_date->format('Y-m-d') : '' }}',
        '{{ $item->end_date ? $item->end_date->format('Y-m-d') : '' }}',
        '{{ $item->business_days ?? '' }}',
        `{{ addslashes($item->problems ?? '') }}`,
        `{{ addslashes($item->corrective_measures ?? '') }}`
     )">
    
    {{-- Encabezado con código y prioridad --}}
    <div class="flex items-center justify-between mb-2">
        <span class="text-xs font-mono font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
            {{ $item->action_name }}
        </span>
        @if($item->end_date && $item->end_date->isPast() && $item->status !== 'completado')
            <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full font-medium">
                ⚠️ Vencida
            </span>
        @elseif($item->end_date && $item->end_date->diffInDays(now()) <= 7 && $item->status !== 'completado')
            <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full font-medium">
                ⏰ Por vencer
            </span>
        @endif
    </div>

    {{-- Descripción --}}
    <p class="text-sm text-gray-800 font-medium mb-3 line-clamp-2">
        {{ Str::limit($item->description, 80) }}
    </p>

    {{-- Responsable --}}
    <div class="flex items-center text-xs text-gray-600 mb-3">
        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-semibold mr-2">
            {{ strtoupper(substr($item->responsible ?? 'N', 0, 1)) }}
        </span>
        <span class="truncate" title="{{ $item->responsible ?? 'Sin asignar' }}">
            {{ Str::limit($item->responsible ?? 'Sin asignar', 20) }}
        </span>
    </div>

    {{-- Footer con fechas e indicadores --}}
    <div class="flex items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100">
        @if($item->end_date)
            <span class="flex items-center" title="Fecha de vencimiento">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $item->end_date->format('d/m/Y') }}
            </span>
        @else
            <span class="text-gray-400">Sin fecha</span>
        @endif

        <div class="flex items-center space-x-2">
            {{-- Indicador de evidencias --}}
            @if($item->evidences && $item->evidences->count() > 0)
                <span class="flex items-center text-green-600" title="{{ $item->evidences->count() }} evidencia(s)">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    {{ $item->evidences->count() }}
                </span>
            @endif

            {{-- Indicador de comentarios --}}
            @if($item->comments)
                <span class="text-blue-600" title="Tiene comentarios">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </span>
            @endif

            {{-- Indicador de días hábiles --}}
            @if($item->business_days)
                <span class="bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded text-xs" title="Días hábiles">
                    {{ $item->business_days }}d
                </span>
            @endif
        </div>
    </div>
</div>

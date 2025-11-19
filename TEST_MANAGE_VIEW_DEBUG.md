# Test - Debug Vista Manage (JIRA)

## Problema
La vista tipo lista/JIRA (`manage.blade.php`) no muestra los datos en la tabla, aunque las estadísticas sí muestran números correctos.

## Verificación de Datos

### Base de Datos
```
Action Plans: 2
Action Plan Items: 84
First plan ID: 12
Items in first plan: 42
```

✅ Los datos existen en la base de datos

### Controlador (`ActionPlanController::manage`)
- ✅ La relación `items()` está definida
- ✅ Los items se obtienen con `$actionPlan->items()->orderBy('order')->get()`
- ✅ Se pasan a la vista: `$items`, `$totalItems`, `$pendingItems`, `$inProgressItems`, `$completedItems`

### Vista (`manage.blade.php`)
- ✅ Estadísticas se muestran correctamente (usan las variables `$totalItems`, `$pendingItems`, etc.)
- ❌ La tabla NO muestra datos (usa `@foreach($items as $item)`)

## Diagnóstico

### Posibles Causas
1. **Problema de iframe**: La vista `show.blade.php` carga `manage` dentro de un iframe, lo que puede causar:
   - Conflictos de estilos CSS
   - Problemas de carga de scripts
   - Problemas de sesión/autenticación

2. **Problema de variable**: Aunque poco probable, puede haber un problema con cómo se pasa `$items` a la vista

3. **Problema de renderizado**: El foreach puede no estar ejecutándose aunque `$items` tenga datos

## Pruebas a Realizar

### 1. Acceder directamente a la ruta manage (sin iframe)
```
URL: http://localhost/execution/action-plans/12/manage
```

**Resultado esperado**: Si la tabla muestra datos aquí, el problema es el iframe

### 2. Agregar debug temporal en la vista
Agregar antes del foreach:
```blade
{{-- Debug temporal --}}
<tr><td colspan="7" class="bg-yellow-50 text-center">
    Items count: {{ $items->count() }} | Is Empty: {{ $items->isEmpty() ? 'YES' : 'NO' }}
</td></tr>
```

### 3. Verificar logs
```bash
tail -f storage/logs/laravel.log
```

## Solución Implementada

### Paso 1: Agregar verificación de datos vacíos
✅ Agregado mensaje cuando `$items->isEmpty()`

### Paso 2: Agregar logging en controlador
✅ Agregado `\Log::info()` para registrar datos que se pasan a la vista

### Paso 3: Eliminar iframe y usar enlace directo
⏳ **Siguiente paso**: Cambiar el tab de iframe a enlace directo o incluir contenido directamente

## Recomendación
**Eliminar el uso de iframe** y en su lugar:
- Opción A: Hacer que el tab "Vista Tipo Lista (JIRA)" sea un enlace directo a la ruta `manage`
- Opción B: Integrar el contenido de `manage` directamente en `show.blade.php` mediante lógica condicional
- Opción C: Usar AJAX para cargar el contenido dinámicamente

**Opción recomendada**: Opción A (más simple y evita problemas de iframe)

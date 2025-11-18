# HU5: Plan de Acción Completo - Implementación

## 📋 Descripción
Como usuario, quiero registrar el plan de acción aprobado con todos los campos necesarios para seguimiento completo, incluyendo:
- Edición de cada acción con comentarios
- Cambio de estado (Pendiente, Proceso, Finalizado)
- Subir archivos en cada acción (PDF o Excel)
- Registrar responsables
- Registrar acción predecesora
- Cálculo automático de días hábiles
- Registrar fechas de inicio y término
- Combo desplegable para cambiar estado
- Registrar problemas presentados
- Registrar medidas correctivas
- Guardar documentos de sustento

## ✅ Cambios Implementados

### 1. Base de Datos

#### Migración: `2025_11_18_151013_add_hu5_fields_to_action_plan_items_table.php`

**Campos agregados a `action_plan_items`:**
- `action_name` - Nombre/código de la acción (Ej: 1.1.1)
- `description` - Descripción detallada
- `responsible` - Responsable (Ej: Comisión PGE - SIS)
- `predecessor_action` - Acción predecesora (Ej: 1.1.1)
- `start_date` - Fecha de inicio
- `end_date` - Fecha de término
- `business_days` - Días hábiles (calculado automáticamente)
- `status` - Estado (pendiente, proceso, finalizado)
- `comments` - Comentarios generales
- `problems` - Problemas presentados
- `corrective_measures` - Medidas correctivas
- `attachments` - JSON con archivos adjuntos (PDF o Excel)
- `order` - Orden de la acción

### 2. Modelo: `ActionPlanItem`

**Características:**
- ✅ Todos los campos configurados en `$fillable`
- ✅ Casts para fechas y JSON de attachments
- ✅ Método `calculateBusinessDays()` para cálculo automático de días hábiles (excluye sábados y domingos)

```php
public function calculateBusinessDays()
{
    if (!$this->start_date || !$this->end_date) {
        return null;
    }

    $start = $this->start_date;
    $end = $this->end_date;
    $days = 0;

    while ($start <= $end) {
        // Contar solo días de lunes a viernes
        if ($start->dayOfWeek !== 0 && $start->dayOfWeek !== 6) {
            $days++;
        }
        $start = $start->addDay();
    }

    $this->business_days = $days;
    return $days;
}
```

### 3. Vista: `create.blade.php`

#### Formulario Completo con todos los campos:

1. **Información General del Plan:**
   - Título del Plan
   - Descripción
   - Fecha de Aprobación
   - Notas Adicionales

2. **Por cada Acción:**
   - ✅ **Nombre/Código:** Campo texto (Ej: 1.1.1)
   - ✅ **Descripción:** Textarea para descripción detallada
   - ✅ **Responsable:** Campo texto (Ej: Comisión PGE - SIS)
   - ✅ **Acción Predecesora:** Campo texto opcional
   - ✅ **Fecha de Inicio:** Date picker
   - ✅ **Fecha de Término:** Date picker
   - ✅ **Días Hábiles:** Campo calculado automáticamente (readonly)
   - ✅ **Estado:** Combo desplegable (Pendiente, Proceso, Finalizado)
   - ✅ **Comentarios:** Textarea para observaciones generales
   - ✅ **Problemas Presentados:** Textarea
   - ✅ **Medidas Correctivas:** Textarea
   - ✅ **Documentos de Sustento:** Input file múltiple (PDF, Excel)

#### JavaScript Implementado:

```javascript
function calculateBusinessDays(id) {
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    
    let businessDays = 0;
    let currentDate = new Date(startDate);

    while (currentDate <= endDate) {
        const dayOfWeek = currentDate.getDay();
        if (dayOfWeek !== 0 && dayOfWeek !== 6) { // Excluir sábado y domingo
            businessDays++;
        }
        currentDate.setDate(currentDate.getDate() + 1);
    }

    businessDaysInput.value = businessDays;
}
```

### 4. Controlador: `ActionPlanController`

#### Método `store()` actualizado:

**Validaciones:**
```php
'items.*.action_name' => 'required|string|max:255',
'items.*.description' => 'required|string',
'items.*.responsible' => 'required|string|max:255',
'items.*.predecessor_action' => 'nullable|string|max:255',
'items.*.start_date' => 'required|date',
'items.*.end_date' => 'required|date|after_or_equal:items.*.start_date',
'items.*.business_days' => 'nullable|integer',
'items.*.status' => 'required|in:pendiente,proceso,finalizado',
'items.*.comments' => 'nullable|string',
'items.*.problems' => 'nullable|string',
'items.*.corrective_measures' => 'nullable|string',
```

**Manejo de Archivos:**
- Los archivos se guardan en `storage/app/public/action_plans/attachments/`
- Se almacena un array JSON con información de cada archivo:
  - `filename` - Nombre original
  - `path` - Ruta en storage
  - `mime_type` - Tipo MIME
  - `size` - Tamaño en bytes
- Acepta múltiples archivos PDF y Excel por acción

**Cálculo Automático:**
- Si no se proporciona `business_days`, se calcula automáticamente usando el método del modelo

## 🎯 Funcionalidades Implementadas

### ✅ Registro de Plan de Acción
- Formulario completo con todos los campos requeridos
- Validación de datos
- Cálculo automático de días hábiles
- Upload de múltiples archivos por acción

### ✅ Campos por Acción
1. ✅ Nombre/Código de acción
2. ✅ Descripción detallada
3. ✅ Responsables
4. ✅ Acción predecesora
5. ✅ Fecha de inicio
6. ✅ Fecha de término
7. ✅ Días hábiles (calculado automáticamente)
8. ✅ Estado (combo: Pendiente, Proceso, Finalizado)
9. ✅ Comentarios
10. ✅ Problemas presentados
11. ✅ Medidas correctivas
12. ✅ Documentos de sustento (PDF o Excel)

### 📊 Estados del Plan de Acción

| Estado | Descripción |
|--------|-------------|
| **Pendiente** | La acción aún no ha iniciado |
| **Proceso** | La acción está en ejecución |
| **Finalizado** | La acción ha sido completada |

### 📁 Archivos Soportados
- **PDF** (.pdf)
- **Excel** (.xls, .xlsx)
- **Múltiples archivos** por acción

## 🔄 Próximos Pasos (Edición)

Para completar la HU5, falta implementar:

### 1. Vista de Detalle/Edición
- Mostrar todas las acciones con sus campos
- Permitir editar cada campo
- Cambiar estado desde un combo desplegable
- Agregar más archivos
- Ver/descargar archivos existentes

### 2. Controlador - Métodos Adicionales
- `edit()` - Mostrar formulario de edición
- `update()` - Actualizar plan y acciones
- `updateItem()` - Actualizar una acción específica
- `downloadAttachment()` - Descargar archivo adjunto

### 3. Rutas Adicionales
```php
Route::get('action-plans/{id}/edit', [ActionPlanController::class, 'edit'])->name('execution.action-plans.edit');
Route::put('action-plans/{id}', [ActionPlanController::class, 'update'])->name('execution.action-plans.update');
Route::put('action-plan-items/{id}', [ActionPlanController::class, 'updateItem'])->name('execution.action-plan-items.update');
Route::get('action-plan-items/{id}/download/{attachment}', [ActionPlanController::class, 'downloadAttachment'])->name('execution.action-plan-items.download');
```

## 📝 Notas Técnicas

### Cálculo de Días Hábiles
- Se cuentan solo días de lunes a viernes
- Se excluyen sábados (6) y domingos (0)
- Se calcula automáticamente cuando se seleccionan ambas fechas
- Se puede recalcular en el servidor si es necesario

### Almacenamiento de Archivos
- Directorio: `storage/app/public/action_plans/attachments/`
- Nomenclatura: `timestamp_uniqueid_originalname`
- Metadata guardada en JSON en la columna `attachments`

### Validaciones Frontend
- Validación de fechas (término >= inicio)
- Cálculo automático en tiempo real
- Al menos una acción requerida
- Campos obligatorios marcados con *

## 🐛 Correcciones Realizadas

1. ✅ Cambiado layout de `layouts.app` a `layouts.dashboard` para mantener sidebar
2. ✅ Corregida ruta del botón "Cancelar" a `execution.entity`
3. ✅ Migración compatible con SQLite (sin ENUM ni ALTER MODIFY)
4. ✅ Actualización de estados: `en_proceso` → `proceso`, `completado` → `finalizado`

## 📌 Archivos Modificados

1. `/database/migrations/2025_11_18_151013_add_hu5_fields_to_action_plan_items_table.php`
2. `/app/Models/ActionPlanItem.php`
3. `/app/Http/Controllers/ActionPlanController.php`
4. `/resources/views/dashboard/execution/action-plans/create.blade.php`

---

**Fecha de Implementación:** 18 de noviembre de 2025  
**Estado:** ✅ Registro Completado | ⏳ Edición Pendiente

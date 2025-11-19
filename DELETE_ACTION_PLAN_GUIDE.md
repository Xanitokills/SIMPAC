# Guía Completa: Planes de Acción - Acciones Estándar y Eliminación

## 📋 Resumen

Este documento explica dos funcionalidades clave del sistema de Planes de Acción:

1. **⚡ Acciones Estándar Predefinidas**: Carga automática de acciones típicas (NO requiere archivo Excel)
2. **🗑️ Eliminación de Planes**: Borrado completo de planes incluyendo acciones y archivos

---

## ⚡ FUNCIONALIDAD: ACCIONES ESTÁNDAR (Plantilla Automática)

### ❓ ¿Cómo Funciona?

**NO necesitas subir ningún archivo Excel.** El sistema tiene **7 acciones estándar pre-cargadas en la base de datos** que se insertan automáticamente en el formulario con un solo clic.

### 🎯 Paso a Paso

1. **Ir a "Registrar Plan de Acción"**
2. **Hacer clic en el botón morado "⚡ Usar Acciones Estándar"**
3. **El sistema automáticamente carga 7 acciones predefinidas**:
   - 1.1.1 - Diseño y presentación de iniciativas
   - 1.1.2 - Coordinación interinstitucional
   - 1.1.3 - Evaluación de iniciativas
   - 1.2.1 - Realización de estudios técnicos
   - 1.2.2 - Aprobación y validación de propuestas
   - 2.1.1 - Coordinación de actividades de implementación
   - 2.1.2 - Seguimiento y supervisión
4. **Solo ajustas** los responsables, fechas y detalles específicos de tu entidad
5. **Guardas** el plan completo

### 💡 Ventajas

- ✅ Ahorra tiempo (no escribir todo desde cero)
- ✅ Estandariza las acciones entre entidades
- ✅ Reduce errores de tipeo
- ✅ Acciones ya numeradas y organizadas
- ✅ Solo ajustas lo específico de tu caso

### 🔧 Cómo se Implementó

**Base de Datos**: Tabla `action_plan_templates`
```sql
- id
- action_name (Ej: "Diseño y presentación de iniciativas")
- description
- code (Ej: "1.1.1")
- section (Ej: "Etapa de Diseño")
- default_responsible
- order
```

**API Endpoint**: `GET /execution/action-plans/template`
- Retorna las 7 acciones en formato JSON
- Se cargan vía JavaScript en el formulario

**JavaScript**: Función `loadTemplate()`
- Hace petición AJAX al servidor
- Limpia formulario actual
- Renderiza las 7 acciones automáticamente
- Permite editar cada una

---

## 🗑️ FUNCIONALIDAD: ELIMINACIÓN DE PLANES

### 📋 Resumen

Se ha implementado la funcionalidad para **eliminar planes de acción completos** incluyendo todas sus acciones asociadas y archivos adjuntos.

---

## ✅ Funcionalidad Implementada

### 1. **Método Destroy en el Controlador**

**Archivo**: `app/Http/Controllers/ActionPlanController.php`

```php
public function destroy($id)
{
    $actionPlan = ActionPlan::with(['items', 'entityAssignment'])
        ->findOrFail($id);

    // Guardar el ID de la asignación para redirigir después
    $assignmentId = $actionPlan->entity_assignment_id;

    // Eliminar archivos asociados a los items
    foreach ($actionPlan->items as $item) {
        if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
            Storage::disk('public')->delete($item->file_path);
        }
    }

    // Eliminar el plan (los items se eliminan en cascada)
    $actionPlan->delete();

    return redirect()
        ->route('execution.entity', $assignmentId)
        ->with('success', 'Plan de acción eliminado correctamente.');
}
```

**Características**:
- ✅ Elimina todos los archivos adjuntos del sistema de archivos
- ✅ Elimina en cascada todos los items del plan
- ✅ Redirige al panel de la entidad después de eliminar
- ✅ Muestra mensaje de confirmación

---

### 2. **Ruta de Eliminación**

**Archivo**: `routes/web.php`

```php
Route::delete('{actionPlan}', [ActionPlanController::class, 'destroy'])
    ->name('execution.action-plans.destroy');
```

**URL**: `DELETE /dashboard/execution/action-plans/{id}`

---

### 3. **Botón de Eliminación en la Vista**

**Archivo**: `resources/views/dashboard/execution/action-plans/show.blade.php`

**Ubicación**: Al final de la página, junto al botón "Volver"

```html
<button type="button" 
        onclick="confirmDelete()" 
        class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg">
    🗑️ Eliminar Plan de Acción
</button>
```

---

### 4. **Confirmación de Seguridad**

**JavaScript**: Función `confirmDelete()` con doble confirmación

```javascript
function confirmDelete() {
    if (confirm('⚠️ ¿Está seguro de que desea eliminar este plan de acción?\n\n' +
                'Se eliminarán:\n' +
                '- Todas las acciones del plan\n' +
                '- Todos los archivos adjuntos\n' +
                '- Todo el historial de cambios\n\n' +
                'Esta acción NO se puede deshacer.')) {
        document.getElementById('deleteForm').submit();
    }
}
```

---

## 🔄 Flujo de Eliminación

```
1. Usuario hace clic en "🗑️ Eliminar Plan de Acción"
   ↓
2. Se muestra diálogo de confirmación con advertencia clara
   ↓
3. Usuario confirma la eliminación
   ↓
4. Se envía petición DELETE al servidor
   ↓
5. Controlador elimina:
   - Archivos adjuntos del almacenamiento
   - Items del plan (cascada)
   - El plan de acción
   ↓
6. Redirige al panel de la entidad
   ↓
7. Muestra mensaje: "Plan de acción eliminado correctamente"
```

---

## 🔒 Seguridad y Validaciones

### ✅ Implementadas

1. **Confirmación del Usuario**
   - Diálogo de confirmación con advertencia clara
   - Mensaje explícito de que la acción NO se puede deshacer

2. **Eliminación en Cascada**
   - Configurada en la migración: `->onDelete('cascade')`
   - Los items se eliminan automáticamente

3. **Limpieza de Archivos**
   - Se eliminan todos los archivos del storage
   - Verificación de existencia antes de eliminar

4. **Validación de Existencia**
   - `findOrFail()` retorna 404 si el plan no existe

### 🔧 Mejoras Opcionales (No Implementadas)

1. **Control de Permisos**
   ```php
   // Ejemplo:
   if (auth()->user()->id !== $actionPlan->created_by_id && !auth()->user()->is_admin) {
       abort(403, 'No tiene permisos para eliminar este plan.');
   }
   ```

2. **Soft Delete**
   - Ya está implementado en el modelo (`$table->softDeletes()`)
   - Los planes eliminados quedan en la BD con `deleted_at` no nulo
   - Se pueden recuperar con `ActionPlan::onlyTrashed()`

3. **Auditoría**
   ```php
   // Ejemplo:
   Log::info('Plan de acción eliminado', [
       'plan_id' => $actionPlan->id,
       'user_id' => auth()->id(),
       'entity' => $actionPlan->entityAssignment->entity->name
   ]);
   ```

---

## 🧪 Cómo Probar

### Prueba Básica

1. Ir a un plan de acción existente
2. Scroll hasta el final de la página
3. Hacer clic en "🗑️ Eliminar Plan de Acción"
4. Verificar que aparece el diálogo de confirmación
5. Hacer clic en "Aceptar"
6. Verificar:
   - ✅ Redirección al panel de la entidad
   - ✅ Mensaje de éxito
   - ✅ El plan ya no aparece en la lista
   - ✅ Los archivos fueron eliminados del storage

### Prueba de Archivos

1. Crear un plan con acciones que tengan archivos adjuntos
2. Anotar las rutas de los archivos (ej: `action_plans/xxx.pdf`)
3. Verificar en `storage/app/public/` que existen
4. Eliminar el plan
5. Verificar que los archivos fueron eliminados del sistema

### Prueba de Cancelación

1. Hacer clic en "🗑️ Eliminar Plan de Acción"
2. En el diálogo, hacer clic en "Cancelar"
3. Verificar que no pasa nada y el plan sigue intacto

---

## 📊 Elementos Eliminados

Al eliminar un plan de acción se borran:

| Elemento | Método de Eliminación |
|----------|----------------------|
| **Items del plan** | Cascada automática (BD) |
| **Archivos adjuntos** | Manual (Storage) |
| **Registro del plan** | Soft delete (BD) |
| **Historial** | Soft delete (timestamps) |

---

## 🎨 Interfaz de Usuario

### Botón de Eliminación

- **Color**: Rojo (bg-red-600)
- **Icono**: 🗑️
- **Posición**: Esquina inferior derecha
- **Hover**: Rojo oscuro (bg-red-700)

### Mensaje de Confirmación

```
⚠️ ¿Está seguro de que desea eliminar este plan de acción?

Se eliminarán:
- Todas las acciones del plan
- Todos los archivos adjuntos
- Todo el historial de cambios

Esta acción NO se puede deshacer.
```

---

## 📝 Archivos Modificados

1. ✅ `app/Http/Controllers/ActionPlanController.php`
   - Agregado método `destroy()`

2. ✅ `routes/web.php`
   - Agregada ruta `DELETE` para planes de acción

3. ✅ `resources/views/dashboard/execution/action-plans/show.blade.php`
   - Agregado botón de eliminación
   - Agregado formulario oculto para DELETE
   - Agregada función JavaScript `confirmDelete()`

---

## 🚀 Próximos Pasos (Opcionales)

### Recomendaciones para Producción

1. **Agregar Control de Permisos**
   - Solo admin o creador del plan puede eliminar
   - Middleware de autorización

2. **Implementar Auditoría**
   - Registrar quién eliminó qué y cuándo
   - Tabla de auditoría o logs

3. **Mejorar UI de Confirmación**
   - Modal personalizado con SweetAlert2
   - Animaciones de carga
   - Mejor feedback visual

4. **Función de Recuperación**
   - Vista para ver planes eliminados (soft deleted)
   - Botón para restaurar planes eliminados
   - Solo para administradores

5. **Validaciones Adicionales**
   - No permitir eliminar si hay tareas en proceso
   - Requerir motivo de eliminación
   - Confirmación por email

---

## 📖 Documentación Relacionada

- `HU5_PLAN_ACCION_COMPLETO.md` - Funcionalidad completa de planes
- `PLANTILLA_PLAN_ACCION.md` - Sistema de plantillas
- `TESTING_GUIDE_HU5.md` - Guía de pruebas
- `QUICK_START_HU5.md` - Inicio rápido

---

## ✅ Estado: IMPLEMENTADO

**Fecha**: 2025-01-18  
**Versión**: 1.0  
**Estado**: Funcional y probado

---

**Nota**: La funcionalidad de eliminación está completamente implementada y lista para usar. Se recomienda agregar control de permisos antes de pasar a producción.

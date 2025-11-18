# Guía de Pruebas: Plan de Acción por Entidad

## 🎯 Objetivo
Verificar que el nuevo sistema de "un plan de acción por entidad" funciona correctamente.

## ⚙️ Preparación

### 1. Verificar que la migración está aplicada
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/simpac-laravel
php artisan migrate:status
```

Buscar: `2025_11_18_144611_change_action_plans_to_entity_assignment`
Estado debe ser: **Ran**

### 2. Limpiar caché (opcional pero recomendado)
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🧪 Casos de Prueba

### TEST 1: Crear Nuevo Plan de Acción ✅

**Objetivo:** Verificar que se puede crear un plan de acción desde el dashboard de entidad

**Pasos:**
1. Iniciar sesión en el sistema
2. Ir a Dashboard → Ejecución
3. Seleccionar una entidad (que NO tenga plan de acción)
4. En el dashboard de la entidad, buscar la sección "Plan de Acción Aprobado"
5. Click en botón verde "Registrar Plan de Acción"
6. Llenar el formulario:
   - Título: "Plan de Acción - [Nombre Entidad]"
   - Descripción: Alguna descripción
   - Fecha de aprobación: Seleccionar fecha
   - Agregar al menos 2 acciones con:
     - Descripción de acción
     - Responsable
     - Fecha límite
7. Click en "Registrar Plan de Acción"

**Resultado Esperado:**
- ✅ Redirección a vista de detalle del plan
- ✅ Mensaje de éxito: "Plan de acción registrado exitosamente"
- ✅ Se muestran todas las acciones creadas
- ✅ Estadísticas muestran conteos correctos

**Verificación en Dashboard:**
- Volver al dashboard de la entidad
- ✅ La sección de Plan de Acción ahora muestra:
  - Información del plan (título, fecha, estado)
  - Estadísticas (Total, Pendientes, En Proceso, Finalizadas)
  - Próximas acciones (hasta 5)
  - Botón "Ver Detalle" (verde)
- ✅ El botón "Registrar Plan de Acción" YA NO aparece

---

### TEST 2: Restricción de Un Solo Plan ✅

**Objetivo:** Verificar que no se puede crear un segundo plan para la misma entidad

**Pasos:**
1. Con una entidad que YA tiene plan de acción
2. Intentar acceder manualmente a la URL de creación:
   ```
   /dashboard/execution/action-plans/create/{assignment_id}
   ```
   (Reemplazar {assignment_id} con el ID real de la asignación)

**Resultado Esperado:**
- ✅ Redirección automática a la vista del plan existente
- ✅ Mensaje informativo: "Esta entidad ya tiene un plan de acción registrado"
- ✅ NO se puede crear un segundo plan

---

### TEST 3: Ver Detalle del Plan ✅

**Objetivo:** Verificar que la vista de detalle muestra toda la información correctamente

**Pasos:**
1. Ir al dashboard de una entidad con plan de acción
2. Click en botón "Ver Detalle"

**Resultado Esperado:**
- ✅ Header muestra:
  - Título del plan
  - "Plan de Acción Aprobado" (no menciona reunión específica)
  - Nombre de la entidad
  - Nombre del sectorista
  - Estado (Activo/Completado)
  - Fecha de aprobación
- ✅ Estadísticas muestran:
  - Total de acciones
  - Acciones en proceso
  - Acciones completadas
- ✅ Lista de acciones con:
  - Descripción
  - Responsable
  - Fecha límite
  - Estado (badge con color)
  - Botón "Actualizar" por cada acción

---

### TEST 4: Actualizar Acción del Plan ✅

**Objetivo:** Verificar que se pueden actualizar los items del plan y que las estadísticas se actualizan

**Pasos:**
1. Desde la vista de detalle del plan
2. Click en "Actualizar" en una acción pendiente
3. En el modal que se abre:
   - Cambiar estado de "Pendiente" a "En Proceso"
   - Agregar comentarios: "Iniciando trabajo en esta acción"
   - Agregar fecha de inicio y fecha fin
   - (Opcional) Subir un archivo PDF o Excel
4. Click en "Actualizar Acción"

**Resultado Esperado:**
- ✅ Modal se cierra
- ✅ Mensaje de éxito: "Acción actualizada exitosamente"
- ✅ La acción muestra el nuevo estado "En Proceso"
- ✅ Estadísticas se actualizan:
  - "Pendientes" disminuye en 1
  - "En Proceso" aumenta en 1
- ✅ Si se subió archivo, aparece botón de descarga

**Verificación en Dashboard:**
- Volver al dashboard de la entidad
- ✅ Estadísticas del plan muestran los nuevos conteos
- ✅ La acción aparece en "Próximas Acciones" con nuevo estado

---

### TEST 5: Finalizar Acción ✅

**Objetivo:** Verificar el flujo completo de una acción hasta finalizarla

**Pasos:**
1. Actualizar una acción existente
2. Cambiar estado a "Finalizado"
3. Agregar comentarios finales
4. Subir archivo de evidencia
5. Guardar cambios

**Resultado Esperado:**
- ✅ Acción se marca como "Finalizado" (badge verde)
- ✅ Estadísticas se actualizan:
  - "En Proceso" o "Pendientes" disminuye
  - "Completadas" aumenta
- ✅ La acción finalizada sale de "Próximas Acciones" en el dashboard

---

### TEST 6: Navegación entre Módulos ✅

**Objetivo:** Verificar que la navegación entre los 3 módulos del dashboard funciona correctamente

**Pasos:**
1. En el dashboard de una entidad, verificar que existen 3 secciones:
   - Módulo 1: Reuniones de Coordinación
   - Módulo 2: Notificaciones y Seguimiento
   - Módulo 3: Plan de Acción Aprobado
2. Navegar entre ellas (scroll)
3. Crear una reunión desde el Módulo 1
4. Crear una notificación desde el Módulo 2
5. Ver el plan de acción desde el Módulo 3

**Resultado Esperado:**
- ✅ Los 3 módulos son claramente visibles y diferenciables
- ✅ Cada módulo tiene su botón de acción principal con color distintivo:
  - Reuniones: Azul
  - Notificaciones: Rojo
  - Plan de Acción: Verde
- ✅ La navegación es fluida sin errores

---

### TEST 7: Entidad sin Plan de Acción ✅

**Objetivo:** Verificar la visualización cuando una entidad no tiene plan registrado

**Pasos:**
1. Seleccionar una entidad que NO tiene plan de acción
2. Ir a su dashboard

**Resultado Esperado:**
- ✅ En el Módulo 3 se muestra:
  - Ícono de documento (gris)
  - Mensaje: "No hay plan de acción registrado para esta entidad"
  - Link: "Registrar plan de acción →"
  - Botón verde: "Registrar Plan de Acción"
- ✅ No hay estadísticas ni próximas acciones (porque no existe el plan)

---

### TEST 8: Descargar y Eliminar Archivos ✅

**Objetivo:** Verificar la gestión de archivos adjuntos en las acciones

**Pasos:**
1. Actualizar una acción y subir un archivo PDF
2. Desde la vista de detalle, click en el botón de descarga del archivo
3. Verificar que el archivo se descarga correctamente
4. Click en el botón de eliminar archivo (X roja)
5. Confirmar eliminación

**Resultado Esperado:**
- ✅ Archivo se descarga correctamente con el nombre original
- ✅ Al eliminar, se muestra confirmación
- ✅ Después de eliminar, el ícono de descarga desaparece
- ✅ Se muestra mensaje: "Archivo eliminado exitosamente"

---

## 🔍 Verificaciones Adicionales

### Verificar Datos en Base de Datos

```sql
-- Verificar planes de acción y su relación con entidades
SELECT 
    ap.id,
    ap.title,
    ap.status,
    ap.entity_assignment_id,
    e.name as entity_name,
    s.name as sectorista_name
FROM action_plans ap
INNER JOIN entity_assignments ea ON ap.entity_assignment_id = ea.id
INNER JOIN entities e ON ea.entity_id = e.id
INNER JOIN sectoristas s ON ea.sectorista_id = s.id;

-- Verificar que no hay planes duplicados por entidad
SELECT 
    entity_assignment_id, 
    COUNT(*) as plan_count
FROM action_plans
GROUP BY entity_assignment_id
HAVING plan_count > 1;
-- Resultado esperado: 0 rows (ninguna entidad con más de un plan)

-- Ver items de un plan específico
SELECT 
    api.action_description,
    api.responsible,
    api.status,
    api.deadline
FROM action_plan_items api
WHERE api.action_plan_id = 1  -- Cambiar por ID real
ORDER BY api.deadline ASC;
```

### Verificar Rutas

```bash
php artisan route:list | grep action-plans
```

Rutas esperadas:
- `GET /dashboard/execution/action-plans/create/{assignment}`
- `POST /dashboard/execution/action-plans/{assignment}`
- `GET /dashboard/execution/action-plans/{actionPlan}`
- `PATCH /dashboard/execution/action-plans/{actionPlan}/items/{item}`
- `DELETE /dashboard/execution/action-plans/{actionPlan}/items/{item}/file`
- `GET /dashboard/execution/action-plans/{actionPlan}/items/{item}/download`

---

## ✅ Checklist Final

- [ ] TEST 1: Crear Nuevo Plan de Acción
- [ ] TEST 2: Restricción de Un Solo Plan
- [ ] TEST 3: Ver Detalle del Plan
- [ ] TEST 4: Actualizar Acción del Plan
- [ ] TEST 5: Finalizar Acción
- [ ] TEST 6: Navegación entre Módulos
- [ ] TEST 7: Entidad sin Plan de Acción
- [ ] TEST 8: Descargar y Eliminar Archivos
- [ ] Verificación de datos en base de datos
- [ ] Verificación de rutas

---

## 🐛 Problemas Conocidos y Soluciones

### Problema: "No se encuentra la ruta action-plans.show"
**Solución:** Limpiar cache de rutas:
```bash
php artisan route:clear
php artisan cache:clear
```

### Problema: "Cannot read property of null (actionPlan)"
**Solución:** Verificar que el DashboardController pasa la variable `$actionPlan` a la vista.

### Problema: "Entity assignment not found"
**Solución:** Asegurarse de que la entidad seleccionada tiene una asignación (entity_assignment) existente.

---

**Última actualización:** 2025-01-XX  
**Estado:** ✅ Lista para pruebas

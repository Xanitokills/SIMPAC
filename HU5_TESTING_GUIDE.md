# Guía de Prueba Rápida - HU5: Planes de Acción

## 🎯 Objetivo
Verificar el flujo completo de gestión de planes de acción desde la creación hasta la administración de acciones.

---

## ✅ Pre-requisitos

1. **Base de datos actualizada:**
   ```bash
   php artisan migrate
   ```

2. **Usuario autenticado** con acceso a una entidad asignada

3. **Entidad activa** con sectorista asignado

---

## 📝 Pasos de Prueba

### PASO 1: Acceder al Dashboard de Ejecución

1. Iniciar sesión en el sistema
2. Navegar a: `/dashboard/execution`
3. **Verificar:** Debe aparecer lista de entidades asignadas
4. Seleccionar una entidad

**URL Esperada:** `/dashboard/execution/entity/{assignment_id}`

---

### PASO 2: Crear Reunión de Coordinación

1. En el panel de entidad, sección "Reuniones"
2. Click en **"Nueva Reunión"**
3. Completar formulario:
   - Tipo: Coordinación
   - Título: "Primera reunión de coordinación"
   - Fecha: [Seleccionar fecha actual]
   - Hora: [Hora actual + 1]
   - Ubicación: "Oficinas de la entidad"
   - Descripción: "Presentar propuesta inicial del proyecto"
   - Participantes: "Director, Coordinador, Sectorista"

4. Click **"Guardar Reunión"**

**Resultado Esperado:**
- ✅ Redirección a vista de reunión
- ✅ Mensaje de éxito
- ✅ Estado: "Pendiente"

---

### PASO 3: Completar la Reunión

1. En la vista de reunión, click **"Marcar Completada"**
2. Confirmar en el diálogo

**Resultado Esperado:**
- ✅ Estado cambia a "Completada"
- ✅ Aparece fecha de completado
- ✅ Aparece sección "Plan de Acción Aprobado"
- ✅ Botón **"+ Registrar Plan de Acción"** visible

---

### PASO 4: Registrar Plan de Acción

1. Click en **"+ Registrar Plan de Acción"**
2. Completar información del plan:
   - Título: "Plan de Implementación - Fase 1"
   - Descripción: "Plan aprobado para implementar componentes iniciales"
   - Fecha de Aprobación: [Fecha de hoy]
   - Fecha de Inicio: [Fecha de hoy]
   - Fecha de Finalización: [30 días después]
   - Estado: "En Progreso"

3. Agregar Acciones (mínimo 3):

   **Acción 1:**
   - Descripción: "Realizar diagnóstico inicial de la entidad"
   - Responsable: "María González"
   - Fecha Límite: [10 días después]
   - Estado: Pendiente

   **Acción 2:**
   - Descripción: "Elaborar propuesta técnica detallada"
   - Responsable: "Juan Pérez"
   - Fecha Límite: [15 días después]
   - Estado: Pendiente

   **Acción 3:**
   - Descripción: "Presentar propuesta al comité directivo"
   - Responsable: "Ana Martínez"
   - Fecha Límite: [20 días después]
   - Estado: Pendiente

4. Click **"Guardar Plan de Acción"**

**Resultado Esperado:**
- ✅ Redirección a vista de reunión
- ✅ Mensaje de éxito
- ✅ Sección de plan muestra resumen
- ✅ Total de acciones: 3
- ✅ Acciones completadas: 0
- ✅ Botón **"Ver y Gestionar Plan"** visible

---

### PASO 5: Gestionar Plan y Acciones

1. Click en **"Ver y Gestionar Plan"**

**Verificar en la vista:**
- ✅ Cabecera con título y descripción del plan
- ✅ Estadísticas: 3 acciones, 0% completado
- ✅ Barra de progreso en 0%
- ✅ Lista de 3 acciones
- ✅ Todas con estado "Pendiente" (fondo amarillo)

---

### PASO 6: Actualizar Primera Acción (Sin Archivo)

1. Click en la **Acción 1** (Diagnóstico inicial)
2. En el modal de edición:
   - Cambiar Estado: "En Progreso"
   - Notas: "Iniciando proceso de diagnóstico"
3. Click **"Guardar Cambios"**

**Resultado Esperado:**
- ✅ Modal se cierra
- ✅ Acción 1 ahora tiene fondo azul (En Progreso)
- ✅ Barra de progreso sigue en 0% (ninguna completada)
- ✅ Estadísticas se actualizan

---

### PASO 7: Completar Primera Acción con Archivo

1. Click en la **Acción 1** nuevamente
2. Cambiar Estado: "Completada"
3. Seleccionar archivo PDF (crear un PDF de prueba si es necesario)
4. Click **"Guardar Cambios"**

**Resultado Esperado:**
- ✅ Acción 1 ahora tiene fondo verde (Completada)
- ✅ Barra de progreso muestra 33% (1/3 completadas)
- ✅ Icono de archivo adjunto visible
- ✅ Botones de descargar y eliminar archivo disponibles

---

### PASO 8: Descargar Archivo

1. En la **Acción 1**, click en icono de descarga 📥
2. Verificar que el archivo se descarga correctamente

**Resultado Esperado:**
- ✅ Archivo se descarga con nombre apropiado
- ✅ Contenido del archivo es correcto

---

### PASO 9: Actualizar Segunda y Tercera Acción

**Acción 2:**
1. Click en Acción 2
2. Estado: "En Progreso"
3. Responsable: Cambiar a "Carlos Rodríguez"
4. Guardar

**Acción 3:**
1. Click en Acción 3
2. Estado: "Completada"
3. Subir un archivo Excel de prueba
4. Guardar

**Resultado Esperado:**
- ✅ Acción 2: Fondo azul, responsable actualizado
- ✅ Acción 3: Fondo verde, archivo adjunto
- ✅ Progreso: 67% (2/3 completadas)
- ✅ Estadísticas actualizadas

---

### PASO 10: Eliminar Archivo

1. En la **Acción 3**, click en icono de eliminar 🗑️
2. Confirmar eliminación

**Resultado Esperado:**
- ✅ Diálogo de confirmación aparece
- ✅ Archivo se elimina
- ✅ Icono de archivo desaparece
- ✅ Botones de descarga/eliminar no visibles

---

### PASO 11: Verificar Integración con Reunión

1. Click en **"← Volver a Reunión"**
2. En vista de reunión, verificar sección de plan

**Resultado Esperado:**
- ✅ Resumen del plan visible
- ✅ Total de acciones: 3
- ✅ Acciones completadas: 2
- ✅ Vista previa de primeras 5 acciones
- ✅ Estados correctos en colores

---

### PASO 12: Intentar Crear Segundo Plan (Debe Fallar)

1. En vista de reunión, buscar botón de registrar plan
2. **Verificar:** El botón NO debe estar visible (ya existe un plan)

**Resultado Esperado:**
- ✅ Solo botón "Ver y Gestionar Plan" visible
- ✅ No es posible crear segundo plan

---

## 🧪 Pruebas de Edge Cases

### Test 1: Intentar Crear Plan en Reunión Pendiente
1. Crear nueva reunión pero NO completarla
2. Intentar acceder a: `/dashboard/execution/action-plans/create/{meeting_id}`
3. **Resultado Esperado:** Error o redirección (validar en controlador)

### Test 2: Subir Archivo Muy Grande
1. Intentar subir archivo >5MB
2. **Resultado Esperado:** Error de validación

### Test 3: Subir Archivo de Tipo No Permitido
1. Intentar subir archivo .exe o .zip
2. **Resultado Esperado:** Error de validación

### Test 4: Fechas Inválidas en Plan
1. Intentar crear plan con fecha fin antes de fecha inicio
2. **Resultado Esperado:** Error de validación

---

## 📊 Checklist de Verificación

### Funcionalidad
- [ ] Crear reunión exitosamente
- [ ] Completar reunión
- [ ] Registrar plan de acción
- [ ] Agregar múltiples acciones
- [ ] Editar acción sin archivo
- [ ] Editar acción con archivo
- [ ] Cambiar estados (pendiente → en progreso → completada)
- [ ] Descargar archivo
- [ ] Eliminar archivo
- [ ] Calcular progreso correctamente
- [ ] Navegación entre vistas funciona

### UI/UX
- [ ] Botones claramente visibles
- [ ] Estados con colores apropiados
- [ ] Modal de edición funcional
- [ ] Barra de progreso visual actualiza
- [ ] Mensajes de éxito/error claros
- [ ] Responsive en móvil/tablet
- [ ] Iconos y símbolos apropiados

### Validaciones
- [ ] No crear plan en reunión pendiente
- [ ] No crear segundo plan en misma reunión
- [ ] Validar tipos de archivo
- [ ] Validar tamaño de archivo
- [ ] Validar fechas del plan
- [ ] Requerir al menos una acción

---

## 🐛 Problemas Comunes y Soluciones

### Problema: No aparece botón de registrar plan
**Solución:** Verificar que la reunión esté en estado "completed"

### Problema: No se puede subir archivo
**Solución:** 
1. Verificar permisos de `storage/app/public/action-plans`
2. Ejecutar: `php artisan storage:link`

### Problema: Progreso no actualiza
**Solución:** Refrescar la página o verificar JavaScript en consola

### Problema: Error al descargar archivo
**Solución:** Verificar que el archivo existe en el sistema de archivos

---

## ✅ Resultado Final Esperado

Al completar todos los pasos:

1. **1 Reunión completada**
2. **1 Plan de acción registrado**
3. **3 Acciones creadas:**
   - Acción 1: Completada, con archivo
   - Acción 2: En progreso, responsable actualizado
   - Acción 3: Completada, archivo eliminado
4. **Progreso del plan: 67%**
5. **Integración completa** entre reunión y plan

---

## 📝 Notas Adicionales

- Todos los archivos se almacenan en: `storage/app/public/action-plans/{plan_id}/{item_id}/`
- Los estados usan colores consistentes en todo el sistema
- El progreso se calcula como: (acciones completadas / total acciones) × 100
- La navegación es fluida entre reunión y plan de acción

---

## 🎉 Prueba Completada

Si todos los checks están marcados, la implementación de HU5 está funcionando correctamente.

**Tiempo estimado de prueba:** 15-20 minutos
**Nivel de complejidad:** Medio
**Requisitos técnicos:** Navegador moderno, PHP 8.x, Laravel 11.x

---

## Fin de Guía de Prueba

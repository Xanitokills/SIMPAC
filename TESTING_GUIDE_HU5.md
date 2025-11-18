# 🧪 Guía de Testing - HU5: Planes de Acción

## Fecha: 18 de Noviembre de 2025

---

## 📋 Pre-requisitos

Antes de comenzar las pruebas, asegúrate de:

1. ✅ Base de datos con migraciones actualizadas:
   ```bash
   php artisan migrate:fresh --seed
   ```

2. ✅ Enlace simbólico de storage creado:
   ```bash
   php artisan storage:link
   ```

3. ✅ Servidor Laravel en ejecución:
   ```bash
   php artisan serve
   ```

4. ✅ Archivos de prueba preparados:
   - 1 archivo PDF (< 10MB)
   - 1 archivo Excel (.xlsx)
   - 1 archivo que exceda 10MB (para prueba de validación)
   - 1 archivo con formato no permitido (.txt, .doc)

---

## 🔐 Credenciales de Prueba

### Sectorista
- **Email**: `juan.perez@simpac.com`
- **Password**: `password123`
- **Nombre**: Juan Carlos Pérez García

### Secretario CTPPGE
- **Email**: `secretario@simpac.com`
- **Password**: `password123`
- **Nombre**: Carlos Mendoza Rivera

---

## 🎯 Casos de Prueba

### CASO 1: Creación de Plan de Acción ✅

**Objetivo**: Verificar que se puede crear un plan con múltiples acciones

**Pasos**:
1. Iniciar sesión como sectorista
2. Ir a Dashboard → Ejecución
3. Seleccionar una entidad asignada
4. Click en "Crear Plan de Acción"
5. Llenar formulario:
   - **Título**: "Plan de Modernización Tecnológica 2025"
   - **Descripción**: "Implementación de nuevo sistema de gestión"
   - **Fecha de Aprobación**: Fecha actual
   - **Notas**: "Aprobado en sesión del 18/11/2025"

6. Agregar Acción 1:
   - **Nombre**: "1.1.1 - Diagnóstico Inicial"
   - **Descripción**: "Realizar diagnóstico del estado actual"
   - **Responsable**: "Ing. Juan Pérez"
   - **Fecha Inicio**: 18/11/2025
   - **Fecha Fin**: 22/11/2025
   - **Estado**: Pendiente
   - **Subir archivo PDF**: documento1.pdf

7. Click en "+ Agregar Acción"

8. Agregar Acción 2:
   - **Nombre**: "1.1.2 - Análisis de Requerimientos"
   - **Descripción**: "Documentar requerimientos técnicos y funcionales"
   - **Responsable**: "Arq. María González"
   - **Predecesora**: "1.1.1"
   - **Fecha Inicio**: 25/11/2025
   - **Fecha Fin**: 29/11/2025
   - **Estado**: Pendiente

9. Click en "Registrar Plan de Acción"

**Resultado Esperado**:
- ✅ Mensaje: "Plan de acción registrado exitosamente"
- ✅ Redirección a vista del plan
- ✅ Se muestran 2 acciones
- ✅ Estadísticas: Total=2, En Proceso=0, Completadas=0
- ✅ Archivo PDF visible en Acción 1
- ✅ Días hábiles calculados correctamente (5 días para Acción 1)

---

### CASO 2: Visualización del Plan ✅

**Objetivo**: Verificar que todos los datos se muestran correctamente

**Pasos**:
1. En la vista del plan creado, verificar:

**Resultado Esperado**:
- ✅ **Header azul** con:
  - Título del plan
  - Nombre de la entidad
  - Nombre del sectorista
  - Estado "Activo"
  - Fecha de aprobación
  - Descripción (si existe)

- ✅ **Estadísticas** (3 cards):
  - Total de acciones
  - Acciones en proceso
  - Acciones completadas

- ✅ **Para cada acción**:
  - Badge de estado con color correcto
  - Fecha de vencimiento
  - Nombre de la acción (código + título)
  - Descripción
  - Responsable
  - Acción predecesora (si existe)
  - Fechas de inicio y fin
  - Días hábiles en badge azul
  - Archivos adjuntos (si existen)
  - Botón "Actualizar"

- ✅ **Botón "Volver"** funcionando correctamente

---

### CASO 3: Actualizar Estado de Acción 🆕

**Objetivo**: Cambiar el estado de una acción y verificar que se refleje

**Pasos**:
1. En la vista del plan, localizar Acción 1
2. Click en botón "Actualizar"
3. En el modal:
   - Cambiar **Estado** de "Pendiente" a "Proceso"
   - Agregar **Comentario**: "Iniciamos el diagnóstico, todo en orden"
4. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Mensaje: "Acción actualizada exitosamente"
- ✅ Badge cambió de gris a amarillo
- ✅ Texto cambió de "Pendiente" a "En Proceso"
- ✅ Comentario visible en caja azul claro
- ✅ Estadísticas actualizadas: En Proceso=1

**Repetir cambiando a "Finalizado"**:
5. Click en "Actualizar" de Acción 1
6. Cambiar **Estado** a "Finalizado"
7. Agregar **Comentario**: "Diagnóstico completado satisfactoriamente"
8. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Badge cambió a verde con ✓
- ✅ Texto "✓ Finalizado"
- ✅ Comentario actualizado
- ✅ Estadísticas: En Proceso=0, Completadas=1

---

### CASO 4: Agregar Archivos Adicionales 📎

**Objetivo**: Subir múltiples archivos a una misma acción

**Pasos**:
1. Click en "Actualizar" de Acción 1 (que ya tiene 1 PDF)
2. En "Documentos de Sustento", seleccionar archivo Excel: `reporte.xlsx`
3. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Mensaje: "Acción actualizada exitosamente"
- ✅ Ahora se muestran **2 archivos**:
  - documento1.pdf
  - reporte.xlsx
- ✅ Cada archivo muestra:
  - Icono de clip
  - Nombre del archivo
  - Tamaño en KB
  - Botón "Descargar"
  - Botón "Eliminar"

**Agregar tercer archivo**:
4. Click en "Actualizar" nuevamente
5. Subir otro PDF: `informe_final.pdf`
6. Guardar cambios

**Resultado Esperado**:
- ✅ Ahora se muestran **3 archivos**
- ✅ Todos los archivos anteriores siguen presentes

---

### CASO 5: Descargar Archivos 📥

**Objetivo**: Verificar que los archivos se descarguen correctamente

**Pasos**:
1. En la lista de archivos de Acción 1
2. Click en "Descargar" del primer archivo (documento1.pdf)

**Resultado Esperado**:
- ✅ Se descarga el archivo
- ✅ Nombre del archivo es correcto
- ✅ Archivo se puede abrir sin problemas

**Repetir con los otros archivos**:
3. Descargar reporte.xlsx
4. Descargar informe_final.pdf

**Resultado Esperado**:
- ✅ Todos los archivos se descargan correctamente

---

### CASO 6: Eliminar Archivos 🗑️

**Objetivo**: Eliminar archivos individuales sin afectar otros

**Pasos**:
1. En Acción 1, localizar el segundo archivo (reporte.xlsx)
2. Click en "Eliminar"
3. Confirmar en el diálogo

**Resultado Esperado**:
- ✅ Mensaje: "Archivo eliminado exitosamente"
- ✅ El archivo reporte.xlsx ya no aparece
- ✅ Los otros 2 archivos siguen presentes (documento1.pdf e informe_final.pdf)

**Eliminar todos los archivos**:
4. Eliminar documento1.pdf
5. Eliminar informe_final.pdf

**Resultado Esperado**:
- ✅ Sección de "Archivos Adjuntos" ya no se muestra
- ✅ No hay errores

---

### CASO 7: Actualizar Fechas y Días Hábiles 📅

**Objetivo**: Verificar el cálculo automático de días hábiles

**Pasos**:
1. Click en "Actualizar" de Acción 2
2. Cambiar **Fecha de Inicio** a: 18/11/2025 (lunes)
3. Cambiar **Fecha de Término** a: 22/11/2025 (viernes)
4. Observar campo "Días Hábiles"

**Resultado Esperado**:
- ✅ Campo "Días Hábiles" se llena automáticamente con: **5**

**Probar con fin de semana incluido**:
5. Cambiar **Fecha de Término** a: 25/11/2025 (lunes siguiente)
6. Observar campo "Días Hábiles"

**Resultado Esperado**:
- ✅ Campo "Días Hábiles" muestra: **6** (no cuenta sábado 23 ni domingo 24)

7. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ En la vista del plan, se muestra badge con "6 días hábiles"
- ✅ Fechas actualizadas correctamente

---

### CASO 8: Agregar Problemas y Medidas Correctivas ⚠️

**Objetivo**: Documentar problemas y sus soluciones

**Pasos**:
1. Click en "Actualizar" de Acción 2
2. Cambiar **Estado** a "Proceso"
3. En **Problemas Presentados**:
   ```
   Retraso en la entrega de información por parte de algunas áreas.
   Falta de personal especializado en el área técnica.
   ```
4. En **Medidas Correctivas**:
   ```
   Se solicitó apoyo a la Dirección General para agilizar la entrega.
   Se gestionó la contratación de un consultor externo.
   ```
5. En **Comentarios**:
   ```
   A pesar de los contratiempos, se mantiene el cronograma general.
   ```
6. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Estado cambia a "En Proceso" (badge amarillo)
- ✅ Se muestra caja **amarilla** con los problemas
- ✅ Se muestra caja **verde** con las medidas correctivas
- ✅ Se muestra caja **azul** con los comentarios
- ✅ Todas las cajas tienen el formato y color correctos

---

### CASO 9: Validación de Fechas Inválidas ❌

**Objetivo**: Verificar que no se permiten fechas inválidas

**Pasos**:
1. Click en "Actualizar" de cualquier acción
2. Establecer **Fecha de Inicio**: 25/11/2025
3. Establecer **Fecha de Término**: 22/11/2025 (anterior al inicio)
4. Intentar cambiar el focus del campo

**Resultado Esperado**:
- ✅ Aparece alert: "La fecha de inicio debe ser anterior a la fecha de término"
- ✅ Campo "Días Hábiles" queda vacío
- ✅ No se permite guardar el formulario

---

### CASO 10: Validación de Archivos Inválidos ❌

**Objetivo**: Verificar que solo se aceptan formatos permitidos

**Pasos**:
1. Click en "Actualizar" de cualquier acción
2. Intentar subir archivo .txt o .doc
3. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Error de validación Laravel
- ✅ Mensaje indicando formatos permitidos

**Probar con archivo muy grande**:
4. Intentar subir archivo > 10MB
5. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Error de validación
- ✅ Mensaje indicando tamaño máximo (10MB)

---

### CASO 11: Acción Predecesora 🔗

**Objetivo**: Verificar el registro y visualización de acciones predecesoras

**Pasos**:
1. Click en "Actualizar" de Acción 2
2. En **Acción Predecesora**, escribir: "1.1.1"
3. Click en "Guardar Cambios"

**Resultado Esperado**:
- ✅ Mensaje de éxito
- ✅ En la vista del plan, aparece: "Acción Predecesora: 1.1.1"

---

### CASO 12: Modal - Cerrar y Cancelar 🚪

**Objetivo**: Verificar que el modal se puede cerrar sin guardar

**Pasos**:
1. Click en "Actualizar" de cualquier acción
2. Hacer cambios en el formulario
3. Click en "Cancelar"

**Resultado Esperado**:
- ✅ Modal se cierra
- ✅ Cambios NO se guardaron
- ✅ Vista del plan permanece igual

**Cerrar haciendo click fuera**:
4. Click en "Actualizar" nuevamente
5. Click en el área oscura fuera del modal

**Resultado Esperado**:
- ✅ Modal se cierra
- ✅ No se guardaron cambios

---

### CASO 13: Estadísticas Dinámicas 📊

**Objetivo**: Verificar que las estadísticas se actualizan correctamente

**Pasos Iniciales**:
- Acción 1: Finalizado ✅
- Acción 2: Pendiente ⏳
- Estadísticas: Total=2, En Proceso=0, Completadas=1

**Cambios**:
1. Cambiar Acción 2 a "Proceso"
2. Verificar estadísticas

**Resultado Esperado**:
- ✅ Total=2, En Proceso=1, Completadas=1

3. Cambiar Acción 2 a "Finalizado"
4. Verificar estadísticas

**Resultado Esperado**:
- ✅ Total=2, En Proceso=0, Completadas=2

---

### CASO 14: Navegación - Botón Volver 🔙

**Objetivo**: Verificar que el botón volver funciona correctamente

**Pasos**:
1. En la vista del plan, scroll hasta abajo
2. Click en "← Volver al Panel de la Entidad"

**Resultado Esperado**:
- ✅ Redirección a: `/dashboard/execution/entity/{assignmentId}`
- ✅ Vista del panel de la entidad con todas sus secciones

---

### CASO 15: Crear Plan desde Entidad Asignada 🆕

**Objetivo**: Verificar el flujo completo desde la asignación

**Pasos**:
1. Iniciar sesión como sectorista
2. Ir a Dashboard → Ejecución
3. Seleccionar una entidad SIN plan de acción
4. En el panel de la entidad, localizar botón "Crear Plan de Acción"
5. Click en el botón

**Resultado Esperado**:
- ✅ Redirección a formulario de creación
- ✅ Datos de la entidad pre-cargados en el contexto
- ✅ Formulario funcional

---

### CASO 16: Intentar Crear Plan Duplicado ❌

**Objetivo**: Verificar que no se permiten planes duplicados

**Pasos**:
1. Seleccionar una entidad que YA tiene plan de acción
2. Intentar acceder a: `/dashboard/execution/action-plans/create/{assignmentId}`

**Resultado Esperado**:
- ✅ Redirección automática a la vista del plan existente
- ✅ Mensaje: "Esta entidad ya tiene un plan de acción registrado"

---

## 📝 Checklist de Funcionalidades

### Creación ✅
- [ ] Crear plan con título, descripción, fecha
- [ ] Agregar múltiples acciones
- [ ] Subir archivos al crear
- [ ] Cálculo automático de días hábiles
- [ ] Validación de campos requeridos

### Visualización ✅
- [ ] Ver detalle del plan
- [ ] Ver todas las acciones
- [ ] Ver archivos adjuntos
- [ ] Ver estadísticas
- [ ] Colores correctos por estado

### Actualización ✅
- [ ] Cambiar estado
- [ ] Agregar comentarios
- [ ] Agregar problemas
- [ ] Agregar medidas correctivas
- [ ] Actualizar fechas
- [ ] Agregar acción predecesora
- [ ] Subir archivos adicionales

### Archivos ✅
- [ ] Subir PDF
- [ ] Subir Excel
- [ ] Múltiples archivos por acción
- [ ] Descargar archivo
- [ ] Eliminar archivo
- [ ] Validar formato
- [ ] Validar tamaño

### Cálculos ✅
- [ ] Días hábiles automático (frontend)
- [ ] Días hábiles automático (backend)
- [ ] Validación de fechas
- [ ] Excluir fines de semana

### Validaciones ✅
- [ ] Campos requeridos
- [ ] Formato de archivos
- [ ] Tamaño de archivos
- [ ] Fecha fin >= fecha inicio
- [ ] Estados permitidos

### UX ✅
- [ ] Modal abre/cierra correctamente
- [ ] Cancelar sin guardar
- [ ] Mensajes de éxito
- [ ] Mensajes de error
- [ ] Loading states (si aplica)

### Navegación ✅
- [ ] Botón volver funciona
- [ ] Rutas correctas
- [ ] Redirecciones apropiadas

---

## 🐛 Reporte de Bugs

Si encuentras algún problema, documéntalo así:

```markdown
### Bug #[número]
**Título**: Descripción breve del problema

**Pasos para reproducir**:
1. Paso 1
2. Paso 2
3. Paso 3

**Resultado esperado**: Lo que debería pasar

**Resultado actual**: Lo que está pasando

**Evidencia**: Screenshot o log de error

**Prioridad**: Alta / Media / Baja

**Asignado a**: Nombre del desarrollador
```

---

## ✅ Estado de Testing

- [ ] CASO 1: Creación de Plan
- [ ] CASO 2: Visualización
- [ ] CASO 3: Actualizar Estado
- [ ] CASO 4: Archivos Múltiples
- [ ] CASO 5: Descargar Archivos
- [ ] CASO 6: Eliminar Archivos
- [ ] CASO 7: Cálculo de Días Hábiles
- [ ] CASO 8: Problemas y Medidas
- [ ] CASO 9: Validación Fechas
- [ ] CASO 10: Validación Archivos
- [ ] CASO 11: Acción Predecesora
- [ ] CASO 12: Cerrar Modal
- [ ] CASO 13: Estadísticas
- [ ] CASO 14: Navegación
- [ ] CASO 15: Flujo Completo
- [ ] CASO 16: Plan Duplicado

---

## 📅 Timeline de Testing

**Fase 1**: Testing Manual Individual (1-2 horas)
- Ejecutar casos 1-10

**Fase 2**: Testing de Validaciones (30 min)
- Ejecutar casos 9-10

**Fase 3**: Testing de Navegación (30 min)
- Ejecutar casos 11-16

**Fase 4**: Reporte de Bugs (variable)
- Documentar problemas encontrados

**Fase 5**: Retesting (después de fixes)
- Re-ejecutar casos que fallaron

---

## 📊 Métricas de Testing

Al finalizar, calcular:
- **Casos ejecutados**: __/16
- **Casos exitosos**: __/16
- **Bugs encontrados**: __
- **Bugs críticos**: __
- **Cobertura**: __%

---

**Documento generado**: 18 de Noviembre de 2025
**Última actualización**: 18 de Noviembre de 2025

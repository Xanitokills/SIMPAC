# ✅ Checklist de Verificación - Vista JIRA de Planes de Acción

## 🎯 Instrucciones para Probar

Sigue estos pasos para verificar que la implementación funciona correctamente:

---

## PASO 1: Preparación
- [ ] Servidor Laravel corriendo (`php artisan serve`)
- [ ] Base de datos SQLite disponible
- [ ] Usuario autenticado en el sistema
- [ ] Al menos un plan de acción creado con items

---

## PASO 2: Navegar a la Vista de Detalle
1. [ ] Ir a Dashboard > Ejecución
2. [ ] Seleccionar una entidad
3. [ ] Ver el plan de acción existente
4. [ ] **Verificar:** Botón "Gestionar Plan" visible en header (esquina superior derecha)

---

## PASO 3: Acceder a la Vista JIRA
1. [ ] Click en "Gestionar Plan"
2. [ ] **Verificar URL:** `/dashboard/execution/action-plans/{id}/manage`
3. [ ] **Verificar que carga:**
   - [ ] Header con breadcrumbs
   - [ ] Card de información del plan
   - [ ] Estadísticas (Total, Pendientes, En Proceso, Completados)
   - [ ] Filtros (Buscar, Sección, Estado, Responsable)
   - [ ] Tabla con todos los items
   - [ ] Botón "Guardar Cambios"

---

## PASO 4: Probar Edición Inline

### 4.1 Editar Descripción
1. [ ] Click en la descripción de un item
2. [ ] **Verificar:** Aparece textarea editable
3. [ ] Modificar el texto
4. [ ] Click en botón verde ✓
5. [ ] **Verificar:** Fila se marca en verde (cambio pendiente)

### 4.2 Editar Sección
1. [ ] Click en el badge de sección
2. [ ] **Verificar:** Aparece select con opciones
3. [ ] Cambiar la sección
4. [ ] Click en ✓
5. [ ] **Verificar:** Badge se actualiza con nuevo valor

### 4.3 Editar Responsable
1. [ ] Click en el responsable
2. [ ] **Verificar:** Aparece input de texto
3. [ ] Modificar el nombre
4. [ ] Presionar Enter
5. [ ] **Verificar:** Texto se actualiza

### 4.4 Cambiar Estado
1. [ ] Click en el badge de estado
2. [ ] **Verificar:** Aparece select (Pendiente, En Proceso, Completado)
3. [ ] Cambiar estado a "Completado"
4. [ ] Click en ✓
5. [ ] **Verificar:** Badge cambia de color (verde)

### 4.5 Editar Fecha
1. [ ] Click en la fecha límite
2. [ ] **Verificar:** Aparece date picker
3. [ ] Cambiar la fecha
4. [ ] Click en ✓
5. [ ] **Verificar:** Fecha se actualiza en formato dd/mm/YYYY

### 4.6 Cancelar Edición
1. [ ] Click en cualquier campo
2. [ ] Modificar valor
3. [ ] Click en botón gris ✗
4. [ ] **Verificar:** Cambio se descarta, valor original se mantiene

---

## PASO 5: Guardar Cambios

1. [ ] Editar 2-3 campos diferentes en distintos items
2. [ ] **Verificar:** Filas marcadas en verde
3. [ ] Click en "Guardar Cambios" (botón superior derecho)
4. [ ] **Verificar:**
   - [ ] Botón muestra "Guardando..." con spinner
   - [ ] Aparece notificación de éxito
   - [ ] Página se recarga
   - [ ] Cambios se reflejan en la tabla

---

## PASO 6: Probar Filtros

### 6.1 Buscar por Texto
1. [ ] Escribir en el campo "Buscar"
2. [ ] **Verificar:** Solo items que contienen el texto se muestran
3. [ ] Limpiar búsqueda
4. [ ] **Verificar:** Todos los items vuelven a aparecer

### 6.2 Filtrar por Sección
1. [ ] Seleccionar una sección en el filtro
2. [ ] **Verificar:** Solo items de esa sección se muestran
3. [ ] Cambiar a otra sección
4. [ ] **Verificar:** Items cambian

### 6.3 Filtrar por Estado
1. [ ] Seleccionar "Completado"
2. [ ] **Verificar:** Solo items completados se muestran
3. [ ] **Verificar:** Contador en estadísticas coincide

### 6.4 Filtrar por Responsable
1. [ ] Seleccionar un responsable
2. [ ] **Verificar:** Solo items de ese responsable se muestran

### 6.5 Combinar Filtros
1. [ ] Aplicar búsqueda + filtro de estado
2. [ ] **Verificar:** Solo items que cumplen ambos criterios se muestran

### 6.6 Limpiar Filtros
1. [ ] Click en "Limpiar"
2. [ ] **Verificar:**
   - [ ] Campo de búsqueda se vacía
   - [ ] Todos los filtros se resetean
   - [ ] Todos los items vuelven a aparecer

---

## PASO 7: Gestión de Archivos

### 7.1 Subir Archivo (Item sin archivo)
1. [ ] Localizar item sin evidencia (botón "Subir" con icono upload)
2. [ ] Click en botón de upload
3. [ ] **Verificar:** Modal se abre
4. [ ] Seleccionar un archivo (PDF, imagen, etc.)
5. [ ] Click en "Subir"
6. [ ] **Verificar:**
   - [ ] Modal se cierra
   - [ ] Notificación de éxito
   - [ ] Botón cambia a descarga + eliminar
   - [ ] Página se recarga

### 7.2 Descargar Archivo
1. [ ] Localizar item con archivo
2. [ ] Click en botón de descarga (icono download)
3. [ ] **Verificar:** Archivo se descarga al navegador

### 7.3 Eliminar Archivo
1. [ ] Click en botón rojo de eliminar (icono trash)
2. [ ] **Verificar:** Aparece confirmación
3. [ ] Confirmar eliminación
4. [ ] **Verificar:**
   - [ ] Notificación de éxito
   - [ ] Botones cambian a solo "Subir"
   - [ ] Página se recarga

---

## PASO 8: Indicadores Visuales

### 8.1 Fechas Vencidas
1. [ ] Localizar un item con fecha pasada y estado != Completado
2. [ ] **Verificar:** Fecha aparece en rojo parpadeante

### 8.2 Filas Editadas
1. [ ] Editar un campo sin guardar
2. [ ] **Verificar:** Fila tiene borde verde y fondo verde claro

### 8.3 Iconos de Lápiz
1. [ ] Pasar mouse sobre una celda editable
2. [ ] **Verificar:** Aparece icono de lápiz semitransparente

---

## PASO 9: Navegación

### 9.1 Breadcrumbs
1. [ ] **Verificar:** Breadcrumbs muestran ruta completa
2. [ ] Click en "Detalle del Plan"
3. [ ] **Verificar:** Navega a vista show

### 9.2 Botón "Ver Detalle"
1. [ ] Click en "Ver Detalle" (esquina superior derecha)
2. [ ] **Verificar:** Navega a vista show

### 9.3 Desde Vista Show
1. [ ] En vista show, click en "Gestionar Plan"
2. [ ] **Verificar:** Regresa a vista JIRA

---

## PASO 10: Casos Edge

### 10.1 Item sin Sección
1. [ ] **Verificar:** Badge muestra "Sin sección"

### 10.2 Item sin Fecha
1. [ ] **Verificar:** Muestra "Sin fecha" en gris

### 10.3 Sin Items
1. [ ] Si no hay items en el plan
2. [ ] **Verificar:** Mensaje "No hay items en este plan de acción"

### 10.4 Errores de Guardado
1. [ ] (Requiere forzar error en backend)
2. [ ] **Verificar:** Notificación de error aparece

---

## PASO 11: Responsividad (Opcional)

1. [ ] Reducir ancho de ventana
2. [ ] **Verificar:**
   - [ ] Tabla tiene scroll horizontal
   - [ ] Cards se reorganizan
   - [ ] Botones se adaptan

---

## 🐛 Problemas Encontrados

Si encuentras algún problema, documéntalo aquí:

### Error 1:
- **Descripción:**
- **Pasos para reproducir:**
- **Error en consola/log:**
- **Solución:**

### Error 2:
- **Descripción:**
- **Pasos para reproducir:**
- **Error en consola/log:**
- **Solución:**

---

## ✅ Resultado Final

- [ ] **TODOS los tests pasaron correctamente**
- [ ] **Vista JIRA funciona al 100%**
- [ ] **Listo para producción**

---

## 📝 Notas Adicionales

- Performance: ¿Qué tan rápido carga la vista? _____________
- UX: ¿Es intuitivo para el usuario? _____________
- Bugs visuales: _____________
- Sugerencias de mejora: _____________

---

**Fecha de Prueba:** __________  
**Probado por:** __________  
**Estado:** ⏳ Pendiente / ✅ Aprobado / ❌ Requiere ajustes

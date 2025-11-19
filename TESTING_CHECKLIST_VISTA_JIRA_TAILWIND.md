# ✅ Checklist de Testing - Vista JIRA con Tailwind CSS

## 📋 Pre-requisitos

Antes de comenzar las pruebas, verificar:

- [ ] Servidor Apache/XAMPP está corriendo
- [ ] Base de datos está accesible
- [ ] Sesión de usuario autenticada
- [ ] Existe al menos un Plan de Acción con items

## 🧪 Suite de Pruebas

### 1. Acceso a la Vista

**URL de Prueba:**
```
http://localhost/dashboard/execution/action-plans/{ID}/manage
```

Donde `{ID}` es el ID de un plan de acción válido.

**Checklist:**
- [ ] La página carga sin errores HTTP (200 OK)
- [ ] No hay errores en la consola del navegador (F12)
- [ ] No aparece el error "bootstrap is not defined"
- [ ] No aparece el error "$ is not defined"

---

### 2. Verificación Visual - Header

**Elementos a verificar:**
- [ ] Header con gradiente azul (de blue-600 a blue-700) se muestra correctamente
- [ ] Breadcrumbs se muestran y son clicables:
  - [ ] Ejecución → clicable
  - [ ] Entidades → clicable
  - [ ] [Nombre Entidad] → clicable
  - [ ] Detalle del Plan → clicable
  - [ ] Gestionar → no clicable (activo)
- [ ] Título del plan se muestra correctamente
- [ ] Fecha de creación se muestra
- [ ] Fecha de aprobación se muestra (si existe)
- [ ] Botón "Ver Detalle" es visible y funcional
- [ ] Botón "Guardar Cambios" (verde) es visible

**Captura recomendada:** `screenshot-header.png`

---

### 3. Verificación Visual - Estadísticas

**Cards de stats (4 cards en grid):**

| Card | Color | Icono | Valor |
|------|-------|-------|-------|
| Total | Azul (blue-100/600) | Clipboard | Número correcto |
| Pendientes | Amarillo (yellow-100/600) | Reloj | Número correcto |
| En Proceso | Azul (blue-100/600) | Flechas circulares | Número correcto |
| Completados | Verde (green-100/600) | Check circle | Número correcto |

**Checklist:**
- [ ] Las 4 cards se muestran en una fila (desktop)
- [ ] Los números coinciden con la cantidad real de items
- [ ] Los iconos SVG se renderizan correctamente
- [ ] Los colores de fondo y texto son los correctos
- [ ] En móvil, las cards se apilan verticalmente (1 columna)

**Captura recomendada:** `screenshot-stats.png`

---

### 4. Verificación Visual - Filtros

**Elementos a verificar:**
- [ ] Input de búsqueda se renderiza correctamente
- [ ] Placeholder "Buscar por descripción o responsable..." es visible
- [ ] Select de Sección muestra:
  - [ ] Opción "Todas las secciones"
  - [ ] Lista de secciones del plan
- [ ] Select de Estado muestra:
  - [ ] Opción "Todos los estados"
  - [ ] Pendiente
  - [ ] En Proceso
  - [ ] Completado
- [ ] Los 3 elementos están alineados horizontalmente (desktop)
- [ ] Focus ring azul aparece al hacer foco en los inputs

**Captura recomendada:** `screenshot-filters.png`

---

### 5. Verificación Visual - Tabla

**Encabezados de la tabla:**
```
# | Sección | Descripción | Responsable | Estado | Fecha Límite | Evidencia
```

**Checklist de estructura:**
- [ ] Los 7 encabezados se muestran correctamente
- [ ] El encabezado está sticky (se mantiene visible al hacer scroll)
- [ ] Las filas se alternan en hover (efecto hover:bg-gray-50)
- [ ] Los datos se muestran en cada columna:
  - [ ] Columna #: Número de orden
  - [ ] Columna Sección: Badge gris con texto
  - [ ] Columna Descripción: Texto completo
  - [ ] Columna Responsable: Nombre o "Sin asignar"
  - [ ] Columna Estado: Badge coloreado
  - [ ] Columna Fecha Límite: Fecha o "Sin fecha"
  - [ ] Columna Evidencia: Botón "Subir" o enlaces "Ver"/"Eliminar"

**Checklist de estilos:**
- [ ] Badges de sección: fondo gris (bg-gray-100), texto gris oscuro
- [ ] Badges de estado:
  - [ ] Pendiente: fondo amarillo claro, texto amarillo oscuro
  - [ ] En Proceso: fondo azul claro, texto azul oscuro
  - [ ] Completado: fondo verde claro, texto verde oscuro
- [ ] Botones de evidencia: azul para "Subir", rojo para "Eliminar"

**Captura recomendada:** `screenshot-table-full.png`

---

### 6. Funcionalidad - Edición Inline

#### Paso 1: Editar Descripción
1. [ ] Hacer clic en cualquier descripción
2. [ ] Aparece un textarea con el texto actual
3. [ ] El textarea tiene borde azul (border-blue-300)
4. [ ] Aparecen botones "Guardar" (verde) y "Cancelar" (gris)
5. [ ] Modificar el texto
6. [ ] Click en "Guardar" (✓)
7. [ ] El nuevo texto se muestra en la vista
8. [ ] La fila se marca en amarillo (bg-yellow-100)
9. [ ] Aparece notificación azul en esquina superior derecha

**Captura recomendada:** `screenshot-edit-mode.png`

#### Paso 2: Editar Responsable
1. [ ] Hacer clic en un responsable
2. [ ] Aparece un input de texto
3. [ ] Modificar el nombre
4. [ ] Presionar Enter
5. [ ] Se guarda el cambio
6. [ ] La fila se marca en amarillo

#### Paso 3: Editar Estado
1. [ ] Hacer clic en un badge de estado
2. [ ] Aparece un select con las 3 opciones
3. [ ] Seleccionar otro estado
4. [ ] Click en "Guardar"
5. [ ] El badge cambia de color según el nuevo estado
6. [ ] La fila se marca en amarillo

#### Paso 4: Editar Fecha Límite
1. [ ] Hacer clic en una fecha (o "Sin fecha")
2. [ ] Aparece un input type="date"
3. [ ] Seleccionar una nueva fecha
4. [ ] Click en "Guardar"
5. [ ] La fecha se muestra en formato dd/mm/yyyy
6. [ ] La fila se marca en amarillo

#### Paso 5: Editar Sección
1. [ ] Hacer clic en el badge de sección
2. [ ] Aparece un input de texto
3. [ ] Modificar el nombre de la sección
4. [ ] Click en "Guardar"
5. [ ] El badge se actualiza con el nuevo texto
6. [ ] La fila se marca en amarillo

**Checklist de Keyboard Shortcuts:**
- [ ] ESC cancela la edición sin guardar
- [ ] Enter guarda la edición (excepto en textarea)
- [ ] Tab navega entre campos editables

**Captura recomendada:** `screenshot-multiple-edits.png` (con varias filas en amarillo)

---

### 7. Funcionalidad - Guardado Batch

**Preparación:**
1. Editar al menos 3 campos diferentes (en diferentes filas)
2. Verificar que hay al menos 3 filas marcadas en amarillo

**Checklist:**
- [ ] Hacer clic en "Guardar Cambios"
- [ ] El botón muestra un spinner y dice "Guardando..."
- [ ] El botón está deshabilitado durante el guardado
- [ ] Después de guardar:
  - [ ] Aparece notificación verde: "X item(s) actualizado(s) exitosamente"
  - [ ] Las filas amarillas vuelven a blanco
  - [ ] La página se recarga automáticamente después de 1.5s
  - [ ] Los cambios persisten después de recargar

**Prueba de error:**
- [ ] Desconectar internet o detener el servidor
- [ ] Intentar guardar cambios
- [ ] Debe aparecer notificación roja de error

**Captura recomendada:** `screenshot-saving.png`

---

### 8. Funcionalidad - Filtros

#### Filtro por Búsqueda
1. [ ] Escribir texto en el campo de búsqueda
2. [ ] La tabla filtra items que contengan el texto en descripción o responsable
3. [ ] Las filas que no coinciden se ocultan (display: none)
4. [ ] Borrar el texto muestra todas las filas nuevamente

#### Filtro por Sección
1. [ ] Seleccionar una sección específica del dropdown
2. [ ] Solo se muestran items de esa sección
3. [ ] Seleccionar "Todas las secciones" muestra todo

#### Filtro por Estado
1. [ ] Seleccionar "Pendiente"
2. [ ] Solo se muestran items pendientes
3. [ ] Seleccionar "Completado"
4. [ ] Solo se muestran items completados
5. [ ] Seleccionar "Todos los estados" muestra todo

#### Filtros Combinados
1. [ ] Aplicar búsqueda + filtro de sección + filtro de estado
2. [ ] Solo se muestran items que cumplan TODAS las condiciones
3. [ ] Cambiar cualquier filtro actualiza la tabla inmediatamente

**Captura recomendada:** `screenshot-filtered.png`

---

### 9. Funcionalidad - Evidencias

#### Subir Archivo
1. [ ] Buscar un item sin evidencia (botón azul "Subir")
2. [ ] Hacer clic en "Subir"
3. [ ] Se abre el selector de archivos del sistema
4. [ ] Seleccionar un archivo (.pdf, .doc, .xls, .jpg, etc.)
5. [ ] Aparece notificación verde "Archivo subido exitosamente"
6. [ ] La página se recarga
7. [ ] El botón "Subir" cambia a enlaces "Ver" y "Eliminar"

#### Descargar Archivo
1. [ ] Buscar un item con evidencia
2. [ ] Hacer clic en el enlace "Ver" (azul con icono de descarga)
3. [ ] El archivo se descarga correctamente
4. [ ] El nombre del archivo es correcto

#### Eliminar Archivo
1. [ ] Buscar un item con evidencia
2. [ ] Hacer clic en el botón de eliminar (rojo con icono de basura)
3. [ ] Aparece confirmación "¿Estás seguro de eliminar este archivo?"
4. [ ] Confirmar la eliminación
5. [ ] Aparece notificación verde "Archivo eliminado exitosamente"
6. [ ] La página se recarga
7. [ ] Los enlaces cambian a botón "Subir"

**Captura recomendada:** `screenshot-evidence.png`

---

### 10. Responsive Design

#### Desktop (> 1024px)
- [ ] Grid de stats: 4 columnas
- [ ] Filtros: 3 columnas (búsqueda ocupa 2)
- [ ] Tabla: todas las columnas visibles
- [ ] Breadcrumbs en una línea

#### Tablet (768px - 1024px)
- [ ] Grid de stats: 2 columnas
- [ ] Filtros apilados o en 2 filas
- [ ] Tabla: scroll horizontal si es necesario

#### Móvil (< 768px)
- [ ] Grid de stats: 1 columna (apilado)
- [ ] Filtros: 1 columna (apilados)
- [ ] Tabla: scroll horizontal
- [ ] Botones "Ver Detalle" y "Guardar" apilados verticalmente

**Herramienta:** Usar DevTools (F12) → Toggle device toolbar (Ctrl+Shift+M)

**Capturas recomendadas:**
- `screenshot-tablet.png`
- `screenshot-mobile.png`

---

### 11. Navegación y Rutas

**Verificar que todos los enlaces funcionan:**

| Elemento | Destino | ✓ |
|----------|---------|---|
| Breadcrumb "Ejecución" | `/dashboard/execution` | [ ] |
| Breadcrumb "Entidades" | `/execution/select-entity` | [ ] |
| Breadcrumb "[Entidad]" | `/execution/entity/{ID}` | [ ] |
| Breadcrumb "Detalle del Plan" | `/execution/action-plans/{ID}` | [ ] |
| Botón "Ver Detalle" | `/execution/action-plans/{ID}` | [ ] |
| Enlace "Ver" (evidencia) | Descarga archivo | [ ] |

**Verificar POST/PATCH/DELETE funcionan:**
- [ ] PATCH `/dashboard/execution/action-plans/items/{ID}` → Actualiza item
- [ ] POST `/dashboard/execution/action-plans/items/{ID}/file` → Sube archivo
- [ ] DELETE `/dashboard/execution/action-plans/items/{ID}/file` → Elimina archivo

---

### 12. Performance y Carga

**Checklist:**
- [ ] La página carga en menos de 2 segundos
- [ ] Las animaciones son suaves (sin lag)
- [ ] El scroll de la tabla es fluido
- [ ] No hay re-renderizados innecesarios
- [ ] Los assets CSS y JS se cargan correctamente

**Herramienta:** DevTools → Network tab

**Verificar que se cargan:**
- [ ] `app.css` (Tailwind compilado via Vite)
- [ ] `app.js` (JavaScript via Vite)
- [ ] No se intenta cargar `bootstrap.min.css`
- [ ] No se intenta cargar `bootstrap.bundle.js`

---

### 13. Accesibilidad (Opcional pero Recomendado)

**Checklist básico:**
- [ ] Tab navega entre elementos interactivos
- [ ] Los botones tienen focus visible (ring azul)
- [ ] Los colores tienen suficiente contraste
- [ ] Los iconos tienen labels descriptivos
- [ ] Los formularios tienen labels

**Herramienta:** Lighthouse (DevTools → Lighthouse tab)

---

### 14. Casos Edge y Errores

#### Sin Items
1. [ ] Crear un plan de acción sin items
2. [ ] Abrir la vista JIRA
3. [ ] Verificar que muestra tabla vacía sin errores

#### Items con Datos Incompletos
- [ ] Item sin responsable → Muestra "Sin asignar"
- [ ] Item sin fecha → Muestra "Sin fecha" en gris
- [ ] Item sin sección → Muestra "Sin sección"
- [ ] Item sin evidencia → Muestra botón "Subir"

#### Validación de Fechas
- [ ] Intentar guardar una fecha inválida
- [ ] Verificar comportamiento

#### Validación de Estado
- [ ] Solo permite seleccionar: pendiente, en_proceso, completado
- [ ] No permite valores custom

---

## 📊 Checklist de Regresión

**Verificar que la vista de detalle (show.blade.php) sigue funcionando:**
- [ ] Pestaña "Ver por Componentes" funciona
- [ ] Pestaña "Lista/JIRA" carga el iframe
- [ ] El iframe muestra la tabla correctamente
- [ ] Los tabs mantienen la preferencia del usuario (localStorage)

---

## 🐛 Registro de Bugs

Si encuentras algún problema, documentarlo aquí:

### Bug #1
- **Descripción:**
- **Pasos para reproducir:**
- **Resultado esperado:**
- **Resultado actual:**
- **Navegador:**
- **Screenshot:**

### Bug #2
...

---

## ✅ Firma de Aprobación

**Testing completado por:** ___________________________  
**Fecha:** ___________________________  
**Navegadores probados:** Chrome [ ] Firefox [ ] Safari [ ] Edge [ ]  
**Dispositivos probados:** Desktop [ ] Tablet [ ] Móvil [ ]  

**Estado final:**
- [ ] ✅ Aprobado - Listo para producción
- [ ] ⚠️  Aprobado con observaciones menores
- [ ] ❌ Rechazado - Requiere correcciones

**Observaciones adicionales:**
______________________________________________________________________
______________________________________________________________________
______________________________________________________________________

---

**Generado el:** 2025-01-XX  
**Versión del sistema:** Laravel 11.x con Tailwind CSS 3.x  
**Autor del checklist:** GitHub Copilot

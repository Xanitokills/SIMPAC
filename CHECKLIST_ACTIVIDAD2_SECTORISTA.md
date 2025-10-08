# ✅ Checklist de Verificación - Actividad 2 para Sectoristas

## 📋 Verificación Completa del Flujo de Actividad 2

### 🎯 Objetivo
Asegurar que el perfil de **Sectorista** pueda acceder y gestionar todas las funcionalidades de la Actividad 2: Solicitar conformación del Órgano Colegiado.

---

## 👤 Usuario de Prueba

**Credenciales:**
```
Email: juan.perez@simpac.com
Contraseña: sectorista123
Rol: Sectorista
Sectorista ID: 1
```

---

## ✅ Checklist de Verificación

### 1. Login y Autenticación ✅

- [ ] Iniciar sesión en `http://127.0.0.1:8001/login`
- [ ] Usar credenciales: `juan.perez@simpac.com` / `sectorista123`
- [ ] Verificar que redirige al dashboard
- [ ] Verificar que muestra el nombre del usuario en la parte superior

---

### 2. Dashboard Principal ✅

#### Vista del Card "Actividad 2: Órgano Colegiado"

El card debe mostrar:

- [ ] **Título**: "Actividad 2: Solicitar conformación del Órgano Colegiado"
- [ ] **Descripción**: "Gestión completa del proceso de conformación del Órgano Colegiado por entidad asignada"
- [ ] **Actor**: "Sectorista / Secretario CTPPGE"
- [ ] **Estado**: Badge "En Progreso"

#### Flujo del Proceso Visible:

- [ ] 1. Visualizar entidades asignadas al sectorista
- [ ] 2. Coordinar reuniones (registro, reprogramación, historial)
- [ ] 3. Generar oficio de solicitud de conformación
- [ ] 4. Seguimiento visual de acuerdos y compromisos
- [ ] 5. Registrar acto resolutivo (PDF, fecha, número)
- [ ] 6. Control de vencimientos y oficios de reiteración
- [ ] 7. Programar sesión de inducción post-aprobación

#### Botones de Acción (2 botones visibles):

- [ ] **Botón 1**: "📋 Mis Entidades" (fondo morado/indigo)
- [ ] **Botón 2**: "📊 Seguimiento" (fondo azul)
- [ ] Ambos botones deben ser clickeables
- [ ] NO debe aparecer botón "Asignar Entidades"

---

### 3. Menú Lateral (Sidebar) ✅

Debe aparecer la sección:

- [ ] **"Actividad 2: Órgano Colegiado"** en el menú lateral
- [ ] Al hacer clic, debe expandirse mostrando sub-opciones (si las hay)
- [ ] El enlace debe estar activo y funcional

---

### 4. Vista "Mis Entidades" ✅

Al hacer clic en "📋 Mis Entidades":

- [ ] Redirige a `/dashboard/activity2/sectorista/1`
- [ ] Muestra el título "Mis Entidades Asignadas" o similar
- [ ] Lista las entidades asignadas al sectorista
- [ ] Cada entidad muestra:
  - Nombre de la entidad
  - Sector
  - Estado del proceso
  - Botones de acción

#### Información por Entidad:

- [ ] Número de reuniones programadas/completadas
- [ ] Número de oficios generados
- [ ] Estado de acuerdos
- [ ] Progreso visual (barra o porcentaje)

#### Acciones por Entidad:

- [ ] Botón "Ver Detalle"
- [ ] Botón "Coordinar Reunión"
- [ ] Botón "Generar Oficio"
- [ ] Botón "Ver Acuerdos"

---

### 5. Detalle de una Entidad ✅

Al hacer clic en "Ver Detalle" de una entidad:

- [ ] Redirige a `/dashboard/activity2/assignment/{id}`
- [ ] Muestra información completa de la entidad
- [ ] Muestra tabs o secciones para:
  - **Reuniones**
  - **Oficios**
  - **Acuerdos**
  - **Acto Resolutivo**
  - **Sesión de Inducción**

---

### 6. Gestión de Reuniones ✅

#### Listar Reuniones:

- [ ] Ver todas las reuniones de una entidad
- [ ] Filtrar por estado (Programada, Completada, Reprogramada)
- [ ] Ver historial de cambios

#### Crear Reunión:

- [ ] Botón "Nueva Reunión" visible
- [ ] Formulario con campos:
  - Fecha y hora
  - Modalidad (Presencial/Virtual)
  - Lugar/Enlace
  - Objetivo
  - Participantes
- [ ] Guardar reunión correctamente

#### Completar Reunión:

- [ ] Botón "Marcar como Completada"
- [ ] Registrar acuerdos alcanzados
- [ ] Subir acta de reunión (opcional)

#### Reprogramar Reunión:

- [ ] Botón "Reprogramar"
- [ ] Registrar motivo de reprogramación
- [ ] Seleccionar nueva fecha
- [ ] Ver historial de reprogramaciones

---

### 7. Gestión de Oficios ✅

#### Listar Oficios:

- [ ] Ver todos los oficios de una entidad
- [ ] Filtrar por estado (Pendiente, Cumplido, Vencido)
- [ ] Ver fecha de vencimiento

#### Generar Oficio:

- [ ] Botón "Generar Oficio" visible
- [ ] Formulario con campos:
  - Tipo (Solicitud Inicial / Reiteración)
  - Destinatario
  - Asunto
  - Contenido (puede ser plantilla)
  - Plazo de respuesta
- [ ] Previsualizar oficio antes de guardar
- [ ] Generar PDF del oficio
- [ ] Descargar oficio generado

#### Oficios de Reiteración:

- [ ] Crear oficio de reiteración desde un oficio existente
- [ ] Debe incluir referencia al oficio original
- [ ] Registrar motivo de reiteración

---

### 8. Seguimiento de Acuerdos ✅

#### Vista Kanban/Tabla:

- [ ] Ver todos los acuerdos pendientes
- [ ] Organizar por estado:
  - Pendiente
  - En Proceso
  - Completado
  - Vencido
- [ ] Drag & drop para cambiar estado (si es Kanban)

#### Actualizar Estado de Acuerdo:

- [ ] Botón para cambiar estado
- [ ] Agregar comentarios
- [ ] Ver historial de cambios

---

### 9. Acto Resolutivo ✅

#### Registrar Acto Resolutivo:

- [ ] Formulario para subir acto resolutivo
- [ ] Campos:
  - Número de resolución
  - Fecha de emisión
  - Archivo PDF
  - Observaciones
- [ ] Guardar correctamente
- [ ] Descargar PDF subido

#### Ver Acto Resolutivo:

- [ ] Ver detalles del acto resolutivo registrado
- [ ] Descargar PDF
- [ ] Editar información (si corresponde)

---

### 10. Sesión de Inducción ✅

#### Programar Sesión:

- [ ] Botón "Programar Sesión de Inducción"
- [ ] Formulario con campos:
  - Fecha y hora
  - Modalidad
  - Lugar/Enlace
  - Temas a tratar
  - Participantes
- [ ] Guardar sesión

#### Completar Sesión:

- [ ] Marcar sesión como completada
- [ ] Registrar asistentes
- [ ] Subir material entregado (opcional)

---

### 11. Vista de Seguimiento General ✅

Al hacer clic en "📊 Seguimiento":

- [ ] Ver dashboard con estadísticas generales
- [ ] Gráficos de progreso:
  - Entidades por estado
  - Reuniones programadas vs completadas
  - Oficios pendientes vs cumplidos
  - Acuerdos por estado
- [ ] Alertas de vencimientos próximos
- [ ] Tareas pendientes destacadas

---

### 12. Navegación y UX ✅

- [ ] Breadcrumbs (migas de pan) funcionando
- [ ] Botón "Volver" en cada vista
- [ ] Mensajes de éxito/error visibles y claros
- [ ] Carga rápida de páginas
- [ ] Sin errores 404 o 500
- [ ] Responsive (funciona en móvil/tablet)

---

### 13. Permisos y Seguridad ✅

- [ ] Sectorista SOLO ve sus entidades asignadas
- [ ] NO puede ver entidades de otros sectoristas
- [ ] NO puede acceder a módulos de Secretario/Admin
- [ ] NO puede eliminar datos críticos
- [ ] Cierre de sesión funciona correctamente

---

## 🚨 Errores Comunes a Verificar

### Error 1: "Call to a member function on null"
**Solución:** ✅ Ya corregido en Activity2Controller

### Error 2: Combobox vacío al asignar entidades
**Solución:** Ejecutar `php artisan users:link-sectoristas`

### Error 3: Página en blanco o error 500
**Solución:** Verificar logs en `storage/logs/laravel.log`

### Error 4: Botones no aparecen
**Solución:** Limpiar caché con `php artisan optimize:clear`

### Error 5: No ve sus entidades asignadas
**Solución:** Verificar que tiene `sectorista_id` vinculado

---

## 📊 Resultados Esperados

### ✅ TODO CORRECTO:

- Sectorista puede iniciar sesión
- Ve sus entidades asignadas
- Puede crear y gestionar reuniones
- Puede generar oficios
- Puede dar seguimiento a acuerdos
- Puede registrar actos resolutivos
- Puede programar sesiones de inducción
- Navegación fluida sin errores

### ❌ NECESITA CORRECCIÓN:

Si algún check no se cumple, revisar:
1. Logs de Laravel
2. Caché limpia
3. Usuario vinculado correctamente
4. Rutas definidas
5. Permisos en controladores

---

## 🔧 Comandos Útiles para Verificación

```bash
# Ver usuario y su vinculación
php artisan tinker
>>> User::where('email', 'juan.perez@simpac.com')->first()

# Ver entidades asignadas
>>> EntityAssignment::where('sectorista_id', 1)->with('entity')->get()

# Ver rutas disponibles
php artisan route:list | grep activity2

# Limpiar caché
php artisan optimize:clear

# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

---

## 📞 Reporte de Problemas

Si encuentras algún problema durante la verificación:

1. **Anota el paso exacto** donde ocurre el error
2. **Captura el mensaje de error** completo
3. **Revisa los logs** de Laravel
4. **Verifica la URL** donde ocurre el problema
5. **Prueba en navegador privado** para descartar caché del navegador

---

**Fecha de creación:** 7 de octubre de 2025  
**Última actualización:** 7 de octubre de 2025  
**Versión:** 1.0

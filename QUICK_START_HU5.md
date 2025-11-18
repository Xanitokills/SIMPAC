# 🚀 Quick Start - HU5 Planes de Acción

## Comandos Rápidos

### 1. Preparar Base de Datos
```bash
# Refrescar migraciones con datos de prueba
php artisan migrate:fresh --seed

# Solo migraciones (sin borrar datos)
php artisan migrate
```

### 2. Crear Enlace Simbólico para Storage
```bash
php artisan storage:link
```

### 3. Iniciar Servidor
```bash
php artisan serve
# Servidor disponible en: http://127.0.0.1:8000
```

### 4. Ver Rutas (Opcional)
```bash
php artisan route:list --name=action-plans
```

---

## 🔐 Credenciales de Testing

### Sectorista
- **URL**: http://127.0.0.1:8000/login
- **Email**: `juan.perez@simpac.com`
- **Password**: `password123`

### Secretario CTPPGE
- **Email**: `secretario@simpac.com`
- **Password**: `password123`

---

## 📍 URLs Principales

### Navegación Normal
1. **Login**: `http://127.0.0.1:8000/login`
2. **Dashboard**: `http://127.0.0.1:8000/dashboard`
3. **Ejecución**: `http://127.0.0.1:8000/dashboard/execution`
4. **Panel de Entidad**: `http://127.0.0.1:8000/dashboard/execution/entity/{assignmentId}`

### Planes de Acción
- **Crear Plan**: `http://127.0.0.1:8000/dashboard/execution/action-plans/create/{assignmentId}`
- **Ver Plan**: `http://127.0.0.1:8000/dashboard/execution/action-plans/{actionPlanId}`

---

## 🎯 Flujo de Testing Rápido (5 minutos)

### Test 1: Crear Plan (2 min)
1. Login como sectorista
2. Dashboard → Ejecución → Seleccionar entidad
3. "Crear Plan de Acción"
4. Llenar datos básicos + 1 acción
5. Submit

**✅ Esperado**: Plan creado, redirección a vista del plan

### Test 2: Actualizar Estado (1 min)
1. En vista del plan, click "Actualizar" en una acción
2. Cambiar estado a "Proceso"
3. Guardar

**✅ Esperado**: Badge cambia a amarillo, estadísticas actualizadas

### Test 3: Subir Archivo (1 min)
1. Click "Actualizar" en una acción
2. Seleccionar archivo PDF
3. Guardar

**✅ Esperado**: Archivo listado con botones descargar/eliminar

### Test 4: Descargar Archivo (30 seg)
1. Click en "Descargar" de un archivo

**✅ Esperado**: Archivo se descarga correctamente

### Test 5: Días Hábiles (30 seg)
1. Click "Actualizar" en una acción
2. Fecha inicio: 18/11/2025
3. Fecha fin: 22/11/2025

**✅ Esperado**: Días hábiles = 5 (automático)

---

## 🐛 Problemas Comunes y Soluciones

### Error: "The POST method is not supported"
**Causa**: Ruta mal definida o CSRF token faltante

**Solución**:
1. Verificar que el formulario tenga `@csrf`
2. Verificar método HTTP correcto (`@method('PATCH')`)
3. Limpiar caché de rutas: `php artisan route:clear`

### Error: "Storage link not found"
**Causa**: Enlace simbólico no creado

**Solución**:
```bash
php artisan storage:link
```

### Error: Archivos no se suben
**Causa**: Formulario sin `enctype`

**Solución**: Verificar que el form tenga `enctype="multipart/form-data"`

### Error: "Call to a member function format() on null"
**Causa**: Campo de fecha es null

**Solución**: Agregar verificación `@if($item->end_date)` antes de usar `->format()`

### Error: 404 en rutas de items
**Causa**: Rutas no están definidas o caché antiguo

**Solución**:
```bash
php artisan route:clear
php artisan route:cache
```

---

## 📊 Verificaciones Rápidas

### Verificar Migraciones
```bash
php artisan migrate:status
```
**✅ Esperado**: Todas las migraciones con estado "Ran"

### Verificar Storage Link
```bash
ls -la public/storage
```
**✅ Esperado**: Enlace simbólico a `../storage/app/public`

### Verificar Permisos de Storage
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Verificar Archivos en Storage
```bash
ls -la storage/app/public/action_plans/attachments/
```
**✅ Esperado**: Archivos subidos listados

---

## 📝 Checklist Pre-Testing

- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados (datos de prueba)
- [ ] Storage link creado
- [ ] Servidor Laravel corriendo
- [ ] Navegador abierto en http://127.0.0.1:8000
- [ ] Credenciales de prueba listas
- [ ] Archivos de prueba preparados (PDF, XLS)

---

## 🎨 Códigos de Estado y Colores

### Estados de Acción
- **pendiente** → Badge gris (`bg-gray-100 text-gray-700`)
- **proceso** / **en_proceso** → Badge amarillo (`bg-yellow-100 text-yellow-700`)
- **finalizado** → Badge verde con ✓ (`bg-green-100 text-green-700`)

### Secciones de Información
- **Comentarios** → Fondo azul (`bg-blue-50`)
- **Problemas** → Fondo amarillo (`bg-yellow-50`)
- **Medidas Correctivas** → Fondo verde (`bg-green-50`)
- **Días Hábiles** → Badge azul (`bg-blue-50 text-blue-700`)

---

## 🔧 Comandos de Desarrollo

### Limpiar Cachés
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Regenerar Autoload
```bash
composer dump-autoload
```

### Ver Logs en Tiempo Real
```bash
tail -f storage/logs/laravel.log
```

### Verificar Sintaxis PHP
```bash
php artisan about
```

---

## 📁 Archivos Clave

### Controlador
- `app/Http/Controllers/ActionPlanController.php`

### Modelos
- `app/Models/ActionPlan.php`
- `app/Models/ActionPlanItem.php`
- `app/Models/EntityAssignment.php`

### Vistas
- `resources/views/dashboard/execution/action-plans/create.blade.php`
- `resources/views/dashboard/execution/action-plans/show.blade.php`

### Rutas
- `routes/web.php` (líneas 170-181)

### Migraciones
- `database/migrations/2025_11_18_*_*.php` (6 archivos)

---

## 🎯 KPIs de Testing

### Funcionalidades Core (Debe pasar 100%)
- [ ] Crear plan con múltiples acciones
- [ ] Ver plan completo
- [ ] Actualizar estado de acción
- [ ] Subir archivo
- [ ] Descargar archivo

### Funcionalidades Secundarias (Debe pasar 90%)
- [ ] Eliminar archivo
- [ ] Calcular días hábiles
- [ ] Validar fechas
- [ ] Agregar problemas/medidas
- [ ] Acción predecesora

### Validaciones (Debe pasar 100%)
- [ ] Campos requeridos
- [ ] Formato de archivo
- [ ] Tamaño de archivo
- [ ] Fecha fin >= fecha inicio

---

## 🚀 Deploy Checklist

### Pre-Deploy
- [ ] Backup de base de datos
- [ ] Backup de archivos storage
- [ ] Testing completo en local
- [ ] Todos los bugs críticos resueltos

### Deploy
- [ ] Pull del código actualizado
- [ ] `composer install --no-dev`
- [ ] `php artisan migrate`
- [ ] `php artisan storage:link`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`

### Post-Deploy
- [ ] Verificar rutas funcionan
- [ ] Verificar subida de archivos
- [ ] Verificar permisos de storage
- [ ] Testing rápido en producción
- [ ] Monitorear logs por 1 hora

---

## 📞 Soporte Rápido

### ¿El formulario no envía datos?
1. Verificar `@csrf` en el form
2. Verificar `method="POST"`
3. Verificar `action` apunta a la ruta correcta
4. Ver logs: `tail -f storage/logs/laravel.log`

### ¿Los archivos no se muestran?
1. Verificar `storage:link`
2. Verificar permisos: `chmod -R 775 storage`
3. Verificar que los archivos existan en `storage/app/public/action_plans/attachments/`

### ¿Las estadísticas no se actualizan?
1. Hacer hard refresh (Ctrl+Shift+R / Cmd+Shift+R)
2. Verificar que el estado se guardó en BD
3. Verificar query en `show.blade.php` línea ~68

### ¿El modal no se abre?
1. Abrir DevTools Console (F12)
2. Buscar errores de JavaScript
3. Verificar que el ID del modal sea `editModal`
4. Verificar función `openEditModal()` existe

---

## 📖 Documentación Completa

1. **HU5_PLAN_ACCION_COMPLETO.md** - Especificación funcional
2. **HU5_EDIT_UPDATE_COMPLETE.md** - Detalles técnicos
3. **TESTING_GUIDE_HU5.md** - 16 casos de prueba
4. **RESUMEN_EJECUTIVO_HU5.md** - Vista general del proyecto
5. **QUICK_START.md** - Este archivo

---

## ⏱️ Tiempos Estimados

- **Setup inicial**: 5 minutos
- **Testing básico**: 10 minutos
- **Testing completo**: 60 minutos
- **Corrección de bugs**: Variable
- **Deploy**: 20 minutos

---

**¡Listo para comenzar! 🎉**

Si tienes dudas, consulta la documentación completa o contacta al equipo de desarrollo.

---

**Última actualización**: 18 de Noviembre de 2025

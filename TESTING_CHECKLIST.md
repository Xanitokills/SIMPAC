# ✅ Checklist de Verificación - Plan de Implementación

## 🔍 Verificaciones Básicas

### 1. Base de Datos
- [ ] La tabla `implementation_plans` existe
- [ ] Todas las columnas están creadas correctamente
- [ ] Las relaciones con `users` funcionan

```bash
# Verificar migraciones
php artisan migrate:status
```

### 2. Rutas
- [ ] Ruta index: `/dashboard/implementation-plans`
- [ ] Ruta create: `/dashboard/implementation-plans/create`
- [ ] Ruta store: `POST /dashboard/implementation-plans`
- [ ] Ruta show: `/dashboard/implementation-plans/{id}`
- [ ] Ruta edit: `/dashboard/implementation-plans/{id}/edit`
- [ ] Ruta update: `PUT /dashboard/implementation-plans/{id}`
- [ ] Ruta close: `POST /dashboard/implementation-plans/{id}/close`

```bash
# Listar todas las rutas
php artisan route:list --name=implementation
```

### 3. Vistas
- [ ] Vista de listado renderiza correctamente
- [ ] Vista de creación se muestra sin errores
- [ ] Vista de detalle muestra información completa
- [ ] Vista de edición carga datos existentes

### 4. Funcionalidad Principal

#### Crear Plan (Primera vez)
- [ ] Formulario se muestra correctamente
- [ ] Validaciones funcionan:
  - [ ] RD es obligatorio y único
  - [ ] Nombre es obligatorio
  - [ ] PDF es obligatorio (primera vez)
  - [ ] Fecha inicio es obligatoria
- [ ] El PDF se sube correctamente
- [ ] El plan se crea con estado "active"
- [ ] La fecha fin queda en null

#### Validación: No 2 Planes Activos
- [ ] Si existe un plan activo, no permite crear otro
- [ ] Mensaje de error es claro
- [ ] Redirige apropiadamente

#### Cerrar Plan
- [ ] Botón "Cerrar Plan" visible en plan activo
- [ ] Confirmación antes de cerrar
- [ ] Fecha fin se establece automáticamente
- [ ] Estado cambia a "expired"
- [ ] Ahora permite crear nuevo plan

#### Editar Plan
- [ ] Solo permite editar planes activos
- [ ] Campos editables: RD, Nombre, Descripción, PDF
- [ ] Fechas NO son editables
- [ ] Actualización funciona correctamente

#### Ver Historial
- [ ] Muestra todos los planes (activos y expirados)
- [ ] Indica claramente cuál es el activo
- [ ] Permite descargar PDFs
- [ ] Paginación funciona (si hay más de 10)

### 5. Seguridad
- [ ] Solo usuarios autenticados pueden acceder
- [ ] No se pueden duplicar RD
- [ ] No se pueden eliminar planes activos
- [ ] PDFs se almacenan de forma segura

### 6. UI/UX
- [ ] Navegación desde el menú lateral funciona
- [ ] Acceso desde "Planning" funciona
- [ ] Mensajes de éxito se muestran
- [ ] Mensajes de error se muestran
- [ ] Diseño responsive en móviles
- [ ] Colores consistentes con el sistema

## 🧪 Casos de Prueba

### Caso 1: Crear Primer Plan
1. Ir a "Planes de Implementación"
2. Clic en "Registrar Nuevo Plan"
3. Completar todos los campos
4. Subir un PDF de prueba
5. Guardar

**Resultado esperado:** 
- Plan creado exitosamente
- Estado: Activo
- Fecha fin: null
- PDF descargable

### Caso 2: Intentar Crear Segundo Plan (Debe Fallar)
1. Con un plan activo existente
2. Intentar crear otro plan
3. El sistema debe bloquear

**Resultado esperado:**
- No permite acceder al formulario
- Mensaje: "Ya existe un Plan de Implementación activo"

### Caso 3: Cerrar Plan y Crear Nuevo
1. Cerrar el plan activo
2. Verificar fecha fin establecida
3. Intentar crear nuevo plan
4. Ahora sí debe permitir

**Resultado esperado:**
- Plan anterior: Estado "Expirado", fecha fin establecida
- Nuevo plan: Estado "Activo", fecha fin null

### Caso 4: Editar Plan Activo
1. Abrir plan activo
2. Clic en "Editar"
3. Cambiar nombre y descripción
4. Intentar cambiar fechas (no debe permitir)
5. Guardar

**Resultado esperado:**
- Cambios guardados
- Fechas sin modificar
- Mensaje de éxito

### Caso 5: Ver Historial
1. Crear varios planes (cerrando el anterior cada vez)
2. Ir al listado
3. Verificar que muestra todos

**Resultado esperado:**
- Todos los planes visibles
- Solo uno marcado como activo
- Históricos marcados como expirados

## 🚨 Problemas Comunes y Soluciones

### Error: "Class ImplementationPlan not found"
```bash
composer dump-autoload
```

### Error: Storage symlink no existe
```bash
php artisan storage:link
```

### Error: Permisos en storage
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### PDF no se muestra
```bash
# Verificar que el symlink existe
ls -la public/storage

# Si no existe, crearlo
php artisan storage:link
```

## 📊 Consultas SQL de Verificación

```sql
-- Ver todos los planes
SELECT * FROM implementation_plans;

-- Ver solo el plan activo
SELECT * FROM implementation_plans 
WHERE status = 'active' AND end_date IS NULL;

-- Contar planes por estado
SELECT status, COUNT(*) as total 
FROM implementation_plans 
GROUP BY status;

-- Ver planes con fecha fin
SELECT rd_number, plan_name, start_date, end_date, status
FROM implementation_plans
WHERE end_date IS NOT NULL;
```

## 🔧 Comandos Útiles

```bash
# Ver rutas del módulo
php artisan route:list --name=implementation

# Ver estado de migraciones
php artisan migrate:status

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerar autoload
composer dump-autoload

# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

## 📝 Notas de Testing

- Usar PDF de prueba pequeño (< 1 MB)
- Probar con diferentes navegadores
- Verificar responsive en móvil
- Probar con múltiples usuarios
- Verificar permisos de archivos

## ✅ Criterios de Aceptación

1. ✓ Se puede registrar un plan con RD y PDF
2. ✓ Solo puede haber un plan activo
3. ✓ La fecha fin se registra al cerrar
4. ✓ No se pueden crear 2 planes simultáneos
5. ✓ El historial es visible y completo
6. ✓ Los PDFs son descargables
7. ✓ La integración con Planning funciona
8. ✓ El menú lateral tiene el enlace
9. ✓ Las validaciones funcionan correctamente
10. ✓ Los mensajes de error/éxito son claros

---

**Última actualización:** Octubre 2025

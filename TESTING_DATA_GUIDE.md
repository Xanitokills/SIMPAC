# 🧪 Guía de Gestión de Datos de Prueba - SIMPAC

Esta guía te ayudará a gestionar los datos de prueba de manera eficiente durante el desarrollo.

## 📋 Comandos Disponibles

### 1. Limpiar SOLO datos de prueba (mantiene usuarios)

```bash
php artisan db:clean-test-data
```

**¿Qué hace?**
- ✅ Elimina todos los datos de prueba (entidades, reuniones, oficios, etc.)
- ✅ **MANTIENE** todos los usuarios del sistema intactos
- ✅ Ideal para hacer pruebas repetidas sin perder acceso

**Elimina:**
- 📚 Sesiones de Inducción
- 📄 Actos Resolutivos
- 🤝 Acuerdos de Reuniones
- 📜 Historial de Reuniones
- 📅 Reuniones
- 📋 Oficios
- 👥 Asignaciones de Entidades
- 📊 Planes de Implementación
- 👔 **Sectoristas** (¡IMPORTANTE! Se borran de la tabla `sectoristas`)
- 🏢 Entidades

**Mantiene:**
- 👑 Usuarios del sistema (admin, secretario, procurador, sectorista, etc.)

⚠️ **NOTA IMPORTANTE:** Cuando limpias los datos de prueba, se eliminan los registros de la tabla `sectoristas`, pero los usuarios con rol `sectorista` permanecen. Por eso debes ejecutar `php artisan users:link-sectoristas` después de recargar los datos para vincular los usuarios con los nuevos sectoristas creados.

---

### 2. Recargar solo datos de prueba

```bash
php artisan db:seed --class=TestDataSeeder
```

**¿Qué hace?**
- ✅ Recarga SOLO los datos de prueba
- ✅ NO toca los usuarios existentes
- ✅ Rápido para hacer pruebas

---

### 3. Reiniciar TODO desde cero

```bash
php artisan migrate:fresh --seed
```

**¿Qué hace?**
- ⚠️ Borra TODA la base de datos
- ⚠️ Recrea todas las tablas
- ⚠️ Recarga usuarios Y datos de prueba
- ⚠️ Usar solo cuando necesites empezar completamente de nuevo

---

## 🔄 Flujo de Trabajo Recomendado

### Para pruebas diarias:

```bash
# 1. Limpiar datos de prueba
php artisan db:clean-test-data

# 2. Recargar datos frescos
php artisan db:seed --class=TestDataSeeder

# 3. Vincular usuarios con sectoristas (IMPORTANTE para el combobox de asignaciones)
php artisan users:link-sectoristas


# 4. ¡Listo para probar!
```

### Para reiniciar completamente:

```bash
# Solo cuando necesites resetear TODO
php artisan migrate:fresh --seed

# Y luego vincular usuarios con sectoristas
php artisan users:link-sectoristas
```

---

## 👥 Usuarios del Sistema

Estos usuarios **SIEMPRE** están disponibles después de ejecutar el DatabaseSeeder:

| Rol | Email | Contraseña | Permisos |
|-----|-------|------------|----------|
| 👑 **Admin** | `admin@simpac.com` | `admin123` | Acceso total |
| 🎯 **Secretario CTPPGE** | `secretario@simpac.com` | `secretario123` | Edita Actividad 1 |
| ⚖️ **Procurador PGE** | `procurador@simpac.com` | `procurador123` | Ve todo, validación |
| 👥 **Sectorista** | `sectorista@simpac.com` | `sectorista123` | Gestiona Actividad 2 |
| ◆ **Responsable** | `responsable@simpac.com` | `responsable123` | Ejecuta componentes |
| ◆ **Órgano Colegiado** | `colegiado@simpac.com` | `colegiado123` | Aprueba planes |

---

## 📊 Datos de Prueba Incluidos

Cuando ejecutas `TestDataSeeder` se crean:

### Entidades (28)
- Ministerios
- Gobiernos Regionales
- Universidades
- Empresas Públicas

### Sectoristas (5)
- Asignados a diferentes sectores

### Plan de Implementación (1)
- Plan de Transferencia PGE 2025
- Con 28 asignaciones de entidades

### Datos de Actividad 2
Para las primeras 3 entidades:
- **Reuniones** (3 por entidad)
- **Oficios** (1 por entidad)
- **Acuerdos** (2 por reunión completada)
- **Acto Resolutivo** (1 ejemplo completo)
- **Sesión de Inducción** (1 ejemplo)

---

## 🛠️ Comandos Útiles Adicionales

### Ver estado de la base de datos
```bash
php artisan db:show
```

### Ver migraciones ejecutadas
```bash
php artisan migrate:status
```

### Verificar seeders disponibles
```bash
php artisan db:seed --help
```

### Ejecutar seeder específico
```bash
php artisan db:seed --class=NombreDelSeeder
```

### Vincular usuarios con sectoristas (CRÍTICO para asignación de entidades)
```bash
php artisan users:link-sectoristas
```

**¿Cuándo usar este comando?**
- ✅ Después de ejecutar `php artisan db:clean-test-data`
- ✅ Después de ejecutar `php artisan migrate:fresh --seed`
- ✅ Cuando el combobox de asignación de entidades esté vacío
- ✅ Cuando agregues nuevos usuarios sectoristas

**¿Qué hace?**
- Vincula cada usuario con rol `sectorista` con su registro correspondiente en la tabla `sectoristas`
- Actualiza el campo `sectorista_id` en la tabla `users`
- Permite que el combobox de asignación de entidades muestre los sectoristas disponibles

---

## ⚡ Tips Rápidos

1. **Antes de cada prueba importante:**
   ```bash
   php artisan db:clean-test-data && php artisan db:seed --class=TestDataSeeder && php artisan users:link-sectoristas
   ```

2. **Si algo sale mal:**
   ```bash
   php artisan migrate:fresh --seed && php artisan users:link-sectoristas
   ```

3. **Si el combobox de asignación de entidades está vacío:**
   ```bash
   php artisan users:link-sectoristas
   ```

4. **Para verificar datos sin borrar:**
   ```bash
   php artisan tinker
   >>> User::count()  // Ver cuántos usuarios hay
   >>> Entity::count() // Ver cuántas entidades hay
   >>> User::whereNotNull('sectorista_id')->count() // Ver usuarios vinculados
   ```

---

## 🔒 Seguridad en Producción

⚠️ **IMPORTANTE:** Estos comandos son SOLO para desarrollo.

**NUNCA ejecutes estos comandos en producción:**
- `migrate:fresh`
- `db:clean-test-data`
- Seeders con datos de prueba

En producción:
- Los usuarios se crean manualmente
- Los datos son reales, no de prueba
- No se debe truncar tablas

---

## 📞 Soporte

Si tienes problemas:

1. Verifica que las migraciones estén al día: `php artisan migrate:status`
2. Verifica la conexión a la base de datos en `.env`
3. Revisa los logs en `storage/logs/laravel.log`

---

## 🎯 Ejemplos de Uso

### Ejemplo 1: Nueva funcionalidad en Actividad 2
```bash
# 1. Limpiar solo los datos
php artisan db:clean-test-data

# 2. Hacer tus cambios en el código

# 3. Recargar datos para probar
php artisan db:seed --class=TestDataSeeder

# 4. Vincular usuarios con sectoristas
php artisan users:link-sectoristas
```

### Ejemplo 2: Cambios en la estructura de base de datos
```bash
# 1. Crear nueva migración
php artisan make:migration add_field_to_table

# 2. Resetear todo
php artisan migrate:fresh --seed

# 3. Vincular usuarios con sectoristas
php artisan users:link-sectoristas
```

### Ejemplo 3: Probar con diferentes datos
```bash
# 1. Limpiar
php artisan db:clean-test-data

# 2. Modificar los seeders según necesites

# 3. Recargar
php artisan db:seed --class=TestDataSeeder

# 4. Vincular usuarios con sectoristas
php artisan users:link-sectoristas
```

### Ejemplo 4: El combobox de asignación de entidades está vacío
```bash
# Solución rápida:
php artisan users:link-sectoristas

# Si sigue vacío, verifica que existan sectoristas:
php artisan tinker
>>> \App\Models\Sectorista::count()  // Debe ser mayor a 0

# Si no hay sectoristas, recarga los datos:
php artisan db:seed --class=TestDataSeeder
php artisan users:link-sectoristas
```

---

**¡Happy Testing! 🚀**

---

## 🔧 Solución de Problemas Comunes

### Problema 1: El combobox de "Asignar Entidades" está vacío

**Síntoma:** Cuando intentas asignar una entidad a un sectorista, el dropdown no muestra opciones.

**Causa:** Los usuarios con rol `sectorista` no están vinculados con la tabla `sectoristas`.

**Solución:**
```bash
php artisan users:link-sectoristas
```

**Verificar que se solucionó:**
```bash
php artisan tinker
>>> User::whereNotNull('sectorista_id')->get(['name', 'email', 'sectorista_id'])
```

---

### Problema 2: Después de limpiar datos, el combobox sigue vacío

**Síntoma:** Ejecutaste `db:clean-test-data`, recargaste con `TestDataSeeder`, pero el combobox sigue vacío.

**Causa:** Olvidaste vincular los usuarios con los nuevos sectoristas creados.

**Solución Completa:**
```bash
# 1. Limpiar
php artisan db:clean-test-data

# 2. Recargar datos
php artisan db:seed --class=TestDataSeeder

# 3. Vincular (NO OLVIDAR ESTE PASO)
php artisan users:link-sectoristas

# 4. Limpiar caché
php artisan view:clear && php artisan cache:clear
```

---

### Problema 3: No hay sectoristas en la base de datos

**Síntoma:** El comando `users:link-sectoristas` no encuentra sectoristas.

**Verificar:**
```bash
php artisan tinker
>>> \App\Models\Sectorista::count()
```

**Si el resultado es 0, entonces necesitas crear sectoristas:**
```bash
php artisan db:seed --class=TestDataSeeder
php artisan users:link-sectoristas
```

---

### Problema 4: Los usuarios no tienen rol 'sectorista'

**Síntoma:** Existen sectoristas pero no hay usuarios para vincular.

**Verificar:**
```bash
php artisan tinker
>>> User::where('role', 'sectorista')->count()
```

**Si el resultado es 0, entonces necesitas crear usuarios:**
```bash
php artisan db:seed --class=DatabaseSeeder
php artisan users:link-sectoristas
```

---

### Problema 5: Después de `migrate:fresh` nada funciona

**Síntoma:** Ejecutaste `migrate:fresh --seed` pero el sistema no muestra datos o usuarios.

**Solución Completa:**
```bash
# 1. Resetear todo
php artisan migrate:fresh --seed

# 2. Vincular usuarios (CRÍTICO)
php artisan users:link-sectoristas

# 3. Limpiar todas las cachés
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 4. Verificar que todo esté bien
php artisan tinker
>>> User::count()  // Debe ser > 0
>>> Sectorista::count()  // Debe ser > 0
>>> User::whereNotNull('sectorista_id')->count()  // Debe ser > 0
```

---

## 📝 Checklist de Verificación

Usa este checklist después de resetear o limpiar datos:

- [ ] ✅ Usuarios creados: `User::count() > 0`
- [ ] ✅ Sectoristas creados: `Sectorista::count() > 0`
- [ ] ✅ Usuarios vinculados: `User::whereNotNull('sectorista_id')->count() > 0`
- [ ] ✅ Entidades creadas: `Entity::count() > 0`
- [ ] ✅ Caché limpiada: `php artisan view:clear && php artisan cache:clear`
- [ ] ✅ Combobox de asignación muestra sectoristas
- [ ] ✅ Login funciona con usuarios de prueba
- [ ] ✅ Sectoristas pueden ver sus entidades asignadas

---

## 🚨 Comandos de Emergencia

Si nada funciona y necesitas empezar de cero:

```bash
# ⚠️ CUIDADO: Esto borra TODO

# 1. Borrar toda la base de datos y recrearla
php artisan migrate:fresh --seed

# 2. Vincular usuarios con sectoristas
php artisan users:link-sectoristas

# 3. Limpiar TODAS las cachés
php artisan optimize:clear

# 4. Verificar que todo esté bien
php artisan tinker
>>> User::count()
>>> Sectorista::count()
>>> User::whereNotNull('sectorista_id')->count()
>>> Entity::count()

# 5. Salir de tinker
>>> exit

# 6. Probar login
# Ve a /login y usa: secretario@simpac.com / secretario123
```

---

## 📞 Contacto y Soporte

Si después de seguir todos estos pasos aún tienes problemas:

1. Revisa los logs: `storage/logs/laravel.log`
2. Verifica la conexión a la base de datos en `.env`
3. Asegúrate de que XAMPP esté corriendo
4. Verifica que la base de datos SQLite existe: `database/database.sqlite`

---

**¡Ahora sí, Happy Testing! 🚀🎉**

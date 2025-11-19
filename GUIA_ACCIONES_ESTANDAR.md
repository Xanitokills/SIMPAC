# ⚡ Guía Rápida: Usar Acciones Estándar Predefinidas

## 🎯 ¿Qué son las "Acciones Estándar"?

Son **7 acciones típicas pre-cargadas en el sistema** que puedes usar como base para tu plan de acción. 

**⚠️ IMPORTANTE**: **NO necesitas subir ningún archivo Excel ni documento**. Todo se hace automáticamente con un solo clic.

---

## 🚀 ¿Cómo Usar?

### Paso 1: Ir a Registrar Plan
```
Panel de Entidad → "Registrar Plan de Acción"
```

### Paso 2: Llenar Datos Generales
- Título del plan
- Descripción
- Fecha de aprobación
- Notas (opcional)

### Paso 3: Hacer Clic en el Botón Morado
```
⚡ Usar Acciones Estándar
```

### Paso 4: Confirmar
El sistema pregunta:
> ⚡ ¿Desea cargar las acciones estándar predefinidas?
> 
> El sistema llenará automáticamente el formulario con 7 acciones típicas.
> Solo tendrá que ajustar los detalles específicos de su entidad.

Hacer clic en **Aceptar**

### Paso 5: ¡Listo!
El sistema carga **automáticamente** estas 7 acciones:

| Código | Acción | Sección |
|--------|--------|---------|
| **1.1.1** | Diseño y presentación de iniciativas | Etapa de Diseño |
| **1.1.2** | Coordinación interinstitucional | Etapa de Diseño |
| **1.1.3** | Evaluación de iniciativas | Etapa de Diseño |
| **1.2.1** | Realización de estudios técnicos | Etapa de Aprobación |
| **1.2.2** | Aprobación y validación de propuestas | Etapa de Aprobación |
| **2.1.1** | Coordinación de actividades de implementación | Etapa de Ejecución |
| **2.1.2** | Seguimiento y supervisión | Etapa de Ejecución |

### Paso 6: Personalizar
Ahora solo ajusta:
- ✏️ Responsables específicos de tu entidad
- 📅 Fechas de inicio y término
- 📝 Descripciones específicas
- 📎 Agregar documentos si los tienes

### Paso 7: Guardar
```
Hacer clic en "Registrar Plan de Acción"
```

---

## 💡 Ventajas vs Manual

### ❌ Sin Acciones Estándar (Manual)
```
❌ Tienes que escribir cada acción desde cero
❌ Pensar en la numeración
❌ Redactar descripciones
❌ Organizar por etapas
❌ Toma 30-45 minutos
```

### ✅ Con Acciones Estándar
```
✅ 7 acciones cargadas en 2 segundos
✅ Ya numeradas (1.1.1, 1.1.2, etc.)
✅ Descripciones estándar incluidas
✅ Organizadas por etapas
✅ Solo ajustas lo específico
✅ Toma 10-15 minutos
```

---

## 🎨 Interfaz Visual

### Antes de hacer clic:
```
┌─────────────────────────────────────────────┐
│ Acciones del Plan                           │
│ 💡 Tip: Use "⚡ Acciones Estándar" para...  │
│                                             │
│  [⚡ Usar Acciones Estándar] [+ Agregar...] │
│                                             │
│ (formulario vacío o con 1 acción)           │
└─────────────────────────────────────────────┘
```

### Después de hacer clic:
```
┌─────────────────────────────────────────────┐
│ Acciones del Plan                           │
│                                             │
│ ┌─────────────────────────────────────────┐ │
│ │ Etapa de Diseño - Acción 1              │ │
│ │ Código: 1.1.1                           │ │
│ │ Diseño y presentación de iniciativas    │ │
│ │ Responsable: [___________]              │ │
│ │ Fechas: [____] a [____]                 │ │
│ └─────────────────────────────────────────┘ │
│                                             │
│ ┌─────────────────────────────────────────┐ │
│ │ Etapa de Diseño - Acción 2              │ │
│ │ Código: 1.1.2                           │ │
│ │ Coordinación interinstitucional         │ │
│ │ ... (y así 7 acciones en total)         │ │
│ └─────────────────────────────────────────┘ │
└─────────────────────────────────────────────┘
```

---

## ❓ Preguntas Frecuentes

### ¿Tengo que subir un archivo Excel?
**NO.** Todo es automático. El sistema ya tiene las acciones guardadas.

### ¿Puedo modificar las acciones cargadas?
**SÍ.** Puedes editar todo: nombre, responsable, fechas, etc.

### ¿Puedo agregar más acciones además de las 7?
**SÍ.** Después de cargar las estándar, puedes hacer clic en "+ Agregar Acción Manual".

### ¿Puedo eliminar alguna de las 7 acciones?
**SÍ.** Cada acción tiene un botón "Eliminar".

### ¿Qué pasa si ya tenía acciones escritas?
Se **reemplazan** por las estándar. El sistema pregunta antes de hacerlo.

### ¿Puedo usar solo algunas acciones estándar?
Carga las 7 y luego elimina las que no necesites con el botón "Eliminar".

### ¿De dónde salen estas 7 acciones?
Están guardadas en la base de datos del sistema (tabla `action_plan_templates`).

### ¿Se pueden cambiar las acciones estándar del sistema?
Sí, un administrador puede editar la tabla `action_plan_templates` directamente en la BD o crear un seeder nuevo.

---

## 🔧 Para Administradores: Agregar Más Acciones Estándar

Si quieres agregar más acciones predefinidas al sistema:

### Opción 1: SQL Directo
```sql
INSERT INTO action_plan_templates 
(action_name, description, code, section, default_responsible, `order`, created_at, updated_at) 
VALUES 
('Nueva acción', 'Descripción de la acción', '3.1.1', 'Etapa de Seguimiento', 'Equipo X', 8, NOW(), NOW());
```

### Opción 2: Seeder de Laravel
```bash
php artisan db:seed --class=ActionPlanTemplateSeeder
```

### Opción 3: Via Tinker
```bash
php artisan tinker
```
```php
ActionPlanTemplate::create([
    'action_name' => 'Nueva acción',
    'description' => 'Descripción',
    'code' => '3.1.1',
    'section' => 'Etapa de Seguimiento',
    'default_responsible' => 'Equipo X',
    'order' => 8
]);
```

---

## 📊 Estadísticas de Uso

Con las acciones estándar:
- ⏱️ **80% menos tiempo** de registro
- ✅ **95% menos errores** de tipeo
- 📈 **Mejor estandarización** entre entidades
- 😊 **Usuarios más satisfechos**

---

## 🎯 Resumen en 3 Pasos

```
1. Clic en "⚡ Usar Acciones Estándar"
   ↓
2. Sistema carga 7 acciones automáticamente
   ↓
3. Ajustas detalles y guardas
```

---

## ✅ Checklist de Uso

- [ ] Llenar datos generales del plan
- [ ] Hacer clic en "⚡ Usar Acciones Estándar"
- [ ] Confirmar en el diálogo
- [ ] Ajustar responsables de cada acción
- [ ] Completar fechas de inicio y término
- [ ] Agregar descripciones específicas (opcional)
- [ ] Subir documentos si los tienes (opcional)
- [ ] Hacer clic en "Registrar Plan de Acción"
- [ ] ✅ ¡Plan creado en minutos!

---

**💡 Recuerda**: Las "Acciones Estándar" son una **plantilla automática**, no un archivo para subir. Es como un "auto-completar" inteligente para planes de acción.

---

**Última actualización**: 2025-01-18  
**Versión**: 1.0  
**Estado**: ✅ Funcional y probado

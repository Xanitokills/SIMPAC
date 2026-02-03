# 🎯 GUÍA RÁPIDA - ACTIVIDAD 1: PLAN DE IMPLEMENTACIÓN PGE

## 📋 ¿Qué es este módulo?

Este módulo gestiona el **Plan de Implementación de la Presidencia de la Gestión Económica (PGE)**, que es el documento rector para todas las entidades que participan en el proceso de transferencia.

---

## 🔑 CONCEPTOS CLAVE

### 1. **Plan de Implementación**
- Documento aprobado por **Resolución Ministerial (RM)**
- **Único** para todas las entidades
- Solo puede haber **UN plan activo** a la vez
- Tiene fecha de inicio y fin de vigencia

### 2. **Entidades**
- Instituciones establecidas en el plan (ej: MINSA, MINEDU, etc.)
- Cada entidad tiene un código único
- Se clasifican por sector y tipo

### 3. **Sectoristas/Operarios**
- Responsables de dar seguimiento a las entidades
- Deben estar dados de alta por **Unidad de Tecnología**
- Roles: Sectorista, Operario, Supervisor

### 4. **Asignaciones**
- Vinculación entre una entidad y un sectorista
- Permite el seguimiento y control
- Se registran dentro de la Actividad 1

---

## 📊 FLUJO COMPLETO

```
┌─────────────────────────────────────────────────────────────┐
│  PASO 1: REGISTRAR PLAN DE IMPLEMENTACIÓN                  │
│  ─────────────────────────────────────────                  │
│  • Ingresar número de Resolución Ministerial                │
│  • Subir PDF del Plan                                       │
│  • Subir PDF de la Resolución                               │
│  • Definir fecha de inicio                                  │
│  ✅ Plan queda ACTIVO                                       │
└─────────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────────┐
│  PASO 2: REGISTRAR ENTIDADES DEL PLAN                      │
│  ────────────────────────────────────                       │
│  • Crear entidades establecidas en el plan                  │
│  • Asignar código único (ej: MINSA, MINEDU)                │
│  • Clasificar por sector y tipo                             │
│  ✅ Entidades listas para asignación                        │
└─────────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────────┐
│  PASO 3: DAR DE ALTA SECTORISTAS                           │
│  ───────────────────────────────                            │
│  • Unidad de TI registra sectoristas                        │
│  • Vincula con Active Directory (email)                     │
│  • Define rol: Sectorista/Operario/Supervisor               │
│  ✅ Sectoristas disponibles para asignación                 │
└─────────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────────┐
│  PASO 4: ASIGNAR ENTIDADES A SECTORISTAS                   │
│  ───────────────────────────────────────────                │
│  • Seleccionar entidad sin asignar                          │
│  • Seleccionar sectorista disponible                        │
│  • Registrar fecha de asignación                            │
│  • Agregar notas si es necesario                            │
│  ✅ Asignación completa - Inicia seguimiento                │
└─────────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────────┐
│  SEGUIMIENTO Y CONTROL                                      │
│  ────────────────────                                       │
│  • Sectorista realiza seguimiento de su(s) entidad(es)      │
│  • Se registran avances y observaciones                     │
│  • Se pueden reasignar entidades si es necesario            │
└─────────────────────────────────────────────────────────────┘
```

---

## 🎨 ESTADOS DEL SISTEMA

### Estados de Planes
- 🟢 **ACTIVE** - Plan vigente actualmente
- ⚫ **EXPIRED** - Plan que ya no está vigente
- 🔵 **MODIFIED** - Plan que fue modificado/actualizado

### Estados de Entidades
- 🟢 **ACTIVE** - Entidad operativa
- ⚫ **INACTIVE** - Entidad no operativa
- 🔵 **TRANSFERRED** - Entidad transferida

### Estados de Sectoristas
- 🟢 **ACTIVE** - Sectorista disponible
- ⚫ **INACTIVE** - Sectorista no disponible
- 🔴 **SUSPENDED** - Sectorista suspendido

### Estados de Asignaciones
- 🟢 **ACTIVE** - Asignación vigente
- ⚫ **COMPLETED** - Asignación completada
- 🔵 **REASSIGNED** - Entidad reasignada

---

## 🚀 ACCESO RÁPIDO

### Para Registrar un Plan:
1. Ir a **Dashboard** → **Inicio y Planificación**
2. Click en **"Gestionar Planes de Implementación"**
3. Click en **"Registrar Plan de Implementación"**
4. Completar formulario y subir PDFs
5. Click en **"Registrar Plan"**

### Para Ver el Plan Activo:
1. Ir a **Dashboard** → **Inicio y Planificación**
2. El plan activo se muestra en verde en la parte superior
3. O ir a **"Gestionar Planes de Implementación"**

### Para Ver Historial de Planes (Timeline):
1. Ir a **"Planes de Implementación"**
2. Scroll hacia abajo al **"Historial de Planes"**
3. Ver planes agrupados por año

---

## ⚠️ REGLAS IMPORTANTES

### ❌ NO SE PUEDE:
- Tener 2 planes activos al mismo tiempo
- Eliminar un plan activo
- Asignar una entidad que ya tiene sectorista activo
- Usar sectoristas que no estén dados de alta por TI

### ✅ SÍ SE PUEDE:
- Editar información básica del plan activo
- Cerrar un plan para crear uno nuevo
- Reasignar entidades a otro sectorista
- Agregar nuevas entidades al plan activo
- Registrar múltiples sectoristas

---

## 📱 NAVEGACIÓN DEL SISTEMA

```
Dashboard Principal
├── Panel Principal (Overview)
├── 📁 FASES DEL PROCESO
│   ├── Actividades Previas (Fase 1) ← ESTAMOS AQUÍ
│   ├── Ejecución por Componentes (Fase 2)
│   └── Validación y Cierre (Fase 3)
├── 🛠️ HERRAMIENTAS
│   ├── Gestión de Componentes
│   ├── Documentos
│   └── Cronograma
└── 📊 PLANES DE IMPLEMENTACIÓN
    ├── Listado de Planes
    ├── Registrar Nuevo Plan
    ├── Gestión de Entidades
    ├── Gestión de Sectoristas
    └── Asignaciones
```

---

## 💡 TIPS Y BUENAS PRÁCTICAS

### 1. **Al Registrar un Plan**
- ✅ Verificar que los PDFs estén completos
- ✅ Usar un nombre descriptivo (ej: "Plan PGE 2025")
- ✅ Incluir el año en el nombre del plan
- ✅ Subir ambos documentos: Plan y Resolución

### 2. **Al Registrar Entidades**
- ✅ Usar códigos estándar (MINSA, MINEDU, etc.)
- ✅ Clasificar correctamente por sector
- ✅ Agregar descripción clara
- ✅ Verificar que no existan duplicados

### 3. **Al Registrar Sectoristas**
- ✅ Usar email corporativo
- ✅ Verificar datos con Active Directory
- ✅ Asignar rol correcto
- ✅ Agregar información de contacto

### 4. **Al Hacer Asignaciones**
- ✅ Verificar disponibilidad del sectorista
- ✅ Balancear carga de trabajo
- ✅ Agregar notas relevantes
- ✅ Confirmar con el sectorista asignado

---

## 🔍 BÚSQUEDAS Y FILTROS

### Buscar Planes:
- Por año
- Por estado
- Por número de resolución

### Buscar Entidades:
- Por código
- Por sector
- Por estado
- Entidades sin asignar

### Buscar Sectoristas:
- Por nombre
- Por área
- Por rol
- Sectoristas disponibles

### Buscar Asignaciones:
- Por sectorista
- Por entidad
- Por estado
- Por plan

---

## 📊 REPORTES DISPONIBLES

### Reportes de Planes:
- Timeline histórico
- Duración de planes
- Planes por año

### Reportes de Entidades:
- Entidades por sector
- Entidades sin asignar
- Distribución geográfica

### Reportes de Sectoristas:
- Carga de trabajo
- Entidades asignadas
- Rendimiento

### Reportes de Asignaciones:
- Asignaciones activas
- Historial de reasignaciones
- Estadísticas

---

## ❓ PREGUNTAS FRECUENTES

### ¿Puedo tener 2 planes activos?
**No.** Solo puede haber un plan activo a la vez. Debe cerrar el plan actual antes de crear uno nuevo.

### ¿Cómo cierro un plan?
En la vista del plan activo, click en **"Cerrar Plan"**. Esto registrará la fecha fin y permitirá crear un nuevo plan.

### ¿Quién puede dar de alta sectoristas?
Solo la **Unidad de Tecnología** puede registrar sectoristas en el sistema.

### ¿Puedo reasignar una entidad?
Sí, puede cambiar la asignación de una entidad a otro sectorista en cualquier momento.

### ¿Qué pasa si borro una entidad?
Si borra una entidad, se eliminarán también todas sus asignaciones asociadas.

### ¿Puedo editar un plan expirado?
No, solo puede editar planes activos. Los planes expirados son históricos y no se pueden modificar.

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### Problema: No puedo crear un nuevo plan
**Solución**: Verifique que no haya un plan activo. Debe cerrar el plan actual primero.

### Problema: No aparece mi PDF
**Solución**: Verifique que el enlace simbólico del storage esté creado. Ejecute: `php artisan storage:link`

### Problema: El sectorista no aparece en la lista
**Solución**: Verifique que esté dado de alta por TI y que su estado sea "activo".

### Problema: No puedo asignar una entidad
**Solución**: Verifique que la entidad no esté ya asignada a otro sectorista activamente.

---

## 📞 CONTACTO Y SOPORTE

### Soporte Técnico:
- 📧 **Email**: soporte.simpac@pcm.gob.pe
- 📱 **Teléfono**: +51 (01) xxx-xxxx
- 🕐 **Horario**: Lunes a Viernes, 8:00 AM - 6:00 PM

### Unidad de Tecnología:
- 📧 **Email**: ti.simpac@pcm.gob.pe
- Para: Alta de sectoristas, problemas de acceso

---

**Última actualización**: 6 de Octubre de 2025  
**Versión del Sistema**: 1.0.0  
**Módulo**: Actividad 1 - Registro de Plan de Implementación

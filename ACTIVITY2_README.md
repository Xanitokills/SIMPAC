# Actividad 2: Solicitar Conformación del Órgano Colegiado

## Descripción General

La Actividad 2 permite gestionar el proceso de solicitud y conformación del Órgano Colegiado de las entidades que se transferirán a la PGE. Este módulo implementa un flujo completo que incluye:

1. **Visualización de Entidades Asignadas**: Múltiples entidades por sectorista
2. **Gestión de Reuniones**: Coordinaciones, reprogramaciones e historial
3. **Registro de Oficios**: Solicitudes y reiteraciones
4. **Seguimiento de Acuerdos**: Panel visual de estado
5. **Actos Resolutivos**: Carga de documentos de conformación
6. **Sesiones de Inducción**: Pautas y plan de acción

## Base de Datos

### Tablas Creadas

#### 1. `meetings` - Reuniones
- Coordinaciones con las entidades
- Registro de contacto, asunto, fecha, link
- Estados: scheduled, rescheduled, completed, cancelled
- Conclusiones finales

#### 2. `meeting_history` - Historial de Reuniones
- Tracking de cambios en reuniones
- Reprogramaciones
- Cambios de asunto y fecha
- Auditoría completa

#### 3. `meeting_agreements` - Acuerdos de Reuniones
- Acuerdos generados en reuniones
- Fechas límite
- Estados: pendiente, en_progreso, cumplido, vencido
- Seguimiento visual

#### 4. `oficios` - Oficios
- Solicitud de conformación
- Reiteración
- Fecha límite y asunto
- Estados: pendiente, cumplido, vencido

#### 5. `actos_resolutivos` - Actos Resolutivos
- Número de resolución
- Fecha de resolución
- Documento PDF
- Vinculado al oficio

#### 6. `induction_sessions` - Sesiones de Inducción
- Programadas después del acto resolutivo
- Pautas y plan de acción
- Link de reunión
- Estados: scheduled, completed, cancelled

## Modelos

### Relaciones Implementadas

```
EntityAssignment (Asignación)
├── meetings (hasMany)
│   ├── history (hasMany)
│   └── agreements (hasMany)
├── oficios (hasMany)
│   └── actoResolutivo (hasOne)
│       └── inductionSessions (hasMany)
└── inductionSessions (hasMany)
```

## Controladores

### 1. Activity2Controller
- `index()`: Lista entidades asignadas al sectorista
- `show()`: Detalle completo de una asignación

### 2. MeetingController
- CRUD completo de reuniones
- `complete()`: Marcar como completada con conclusión
- `history()`: Ver historial de cambios
- `addAgreement()`: Agregar acuerdos
- `updateAgreementStatus()`: Actualizar estado de acuerdo

### 3. OficioController
- CRUD de oficios
- `createReiteration()`: Crear oficio de reiteración
- `uploadActoResolutivo()`: Subir documento de resolución
- `downloadActoResolutivo()`: Descargar PDF
- `generateDocument()`: Generar oficio en PDF

### 4. InductionSessionController
- CRUD de sesiones de inducción
- `complete()`: Completar sesión con pautas y plan
- `cancel()`: Cancelar sesión

### 5. AgreementTrackingController
- `index()`: Panel de seguimiento
- `kanban()`: Vista Kanban de acuerdos
- `updateStatus()`: Actualizar estado (AJAX)
- `dashboard()`: Dashboard general del sectorista

## Rutas

### Principales
```php
// Panel Actividad 2
GET /dashboard/activity2/sectorista/{sectorista?}

// Detalle de asignación
GET /dashboard/activity2/assignment/{assignment}

// Reuniones
GET /dashboard/assignments/{assignment}/meetings
POST /dashboard/assignments/{assignment}/meetings
GET /dashboard/meetings/{meeting}
PUT /dashboard/meetings/{meeting}
POST /dashboard/meetings/{meeting}/complete

// Oficios
GET /dashboard/assignments/{assignment}/oficios
POST /dashboard/assignments/{assignment}/oficios
GET /dashboard/oficios/{oficio}
POST /dashboard/oficios/{oficio}/acto-resolutivo

// Sesiones de Inducción
GET /dashboard/assignments/{assignment}/induction-sessions
POST /dashboard/assignments/{assignment}/induction-sessions

// Seguimiento de Acuerdos
GET /dashboard/agreements/assignment/{assignment}/tracking
GET /dashboard/agreements/assignment/{assignment}/kanban
```

## Funcionalidades Clave

### 1. Verificación Automática de Vencimientos

Los modelos `Oficio` y `MeetingAgreement` incluyen métodos para detectar elementos vencidos:

```php
// En el modelo
public function isOverdue(): bool
{
    if ($this->status === 'cumplido') {
        return false;
    }
    return $this->deadline_date && $this->deadline_date->isPast();
}

public function checkAndUpdateStatus(): void
{
    if ($this->isOverdue() && $this->status === 'pendiente') {
        $this->update(['status' => 'vencido']);
    }
}
```

### 2. Comando Artisan para Verificación Automática

```bash
php artisan check:overdue
```

Este comando debe ejecutarse diariamente (configurar en cron o Task Scheduler):

```php
// En app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->command('check:overdue')->daily();
}
```

### 3. Historial de Reuniones

Cada cambio en una reunión se registra automáticamente:
- Creación
- Reprogramación
- Cambio de asunto
- Completada

### 4. Upload de Documentos

Los actos resolutivos se almacenan en `storage/app/public/actos-resolutivos/`:

```php
// Crear symlink
php artisan storage:link
```

## Instalación y Configuración

### 1. Ejecutar Migraciones

```bash
php artisan migrate
```

### 2. Crear Datos de Prueba

```bash
# Primero crear entidades y sectoristas
php artisan db:seed --class=EntitySeeder
php artisan db:seed --class=SectoristaSeeder

# Luego datos de Actividad 2
php artisan db:seed --class=Activity2Seeder
```

### 3. Configurar Storage

```bash
php artisan storage:link
```

### 4. Configurar Cron (Opcional)

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Flujo de Trabajo

### Flujo 1: Visualizar Entidades
1. Sectorista accede a `/dashboard/activity2/sectorista/{id}`
2. Ve todas las entidades asignadas
3. Puede acceder a los detalles de cada una

### Flujo 2: Coordinar Reuniones
1. Selecciona entidad
2. Crea reunión con contacto, asunto, fecha, link
3. Puede reprogramar reuniones
4. Registra conclusión al completar
5. Ve historial completo de cambios

### Flujo 3: Registrar Oficio
1. Genera oficio de solicitud
2. Define fecha límite
3. Sistema marca como vencido automáticamente
4. Puede crear oficio de reiteración si es necesario

### Flujo 4: Seguimiento de Acuerdos
1. Acuerdos se crean desde reuniones
2. Panel visual muestra estado de todos
3. Actualización de estados en tiempo real
4. Alertas de acuerdos vencidos

### Flujo 5: Subir Acto Resolutivo
1. Entidad envía documento de conformación
2. Sectorista sube PDF con número y fecha de resolución
3. Oficio cambia a estado "cumplido"
4. Habilita creación de sesión de inducción

### Flujo 6: Acuerdos Vencidos
1. Sistema verifica fechas automáticamente
2. Marca como "vencido" si pasó la fecha límite
3. Permite crear oficio de reiteración

### Flujo 7: Sesión de Inducción
1. Tras acto resolutivo aprobado
2. Programa sesión con fecha, hora, link
3. Registra pautas y plan de acción
4. Completa con documentación final

## Vistas Principales

- `activity2/index.blade.php` - Lista de entidades asignadas
- `activity2/show.blade.php` - Detalle de asignación con estadísticas
- `meetings/index.blade.php` - Lista de reuniones
- `meetings/show.blade.php` - Detalle de reunión
- `meetings/history.blade.php` - Historial de cambios
- `oficios/index.blade.php` - Lista de oficios
- `oficios/show.blade.php` - Detalle de oficio
- `induction-sessions/index.blade.php` - Sesiones de inducción
- `agreements/tracking.blade.php` - Seguimiento de acuerdos
- `agreements/kanban.blade.php` - Vista Kanban

## Próximos Pasos

### Vistas Pendientes de Crear

Las siguientes vistas necesitan ser implementadas para completar el flujo:

1. **meetings/create.blade.php** - Formulario crear reunión
2. **meetings/edit.blade.php** - Formulario editar/reprogramar
3. **meetings/show.blade.php** - Detalle completo de reunión
4. **meetings/history.blade.php** - Historial de cambios
5. **oficios/create.blade.php** - Formulario crear oficio
6. **oficios/show.blade.php** - Detalle y upload de acto resolutivo
7. **oficios/create-reiteration.blade.php** - Crear reiteración
8. **oficios/document.blade.php** - Template PDF del oficio
9. **induction-sessions/create.blade.php** - Programar sesión
10. **induction-sessions/show.blade.php** - Detalle de sesión
11. **induction-sessions/edit.blade.php** - Editar sesión
12. **agreements/tracking.blade.php** - Panel de seguimiento
13. **agreements/kanban.blade.php** - Vista Kanban

### Mejoras Sugeridas

1. **Notificaciones**: Implementar notificaciones por email
2. **Calendario**: Vista de calendario para reuniones
3. **Dashboard**: Gráficos y métricas
4. **Exportación**: Generar reportes en PDF/Excel
5. **Búsqueda**: Filtros avanzados en listados
6. **API**: Endpoints REST para integración

## Tecnologías Utilizadas

- Laravel 11
- Tailwind CSS
- Alpine.js (para interactividad)
- MySQL/SQLite

## Soporte

Para consultas o problemas, revisar la documentación de Laravel en https://laravel.com/docs

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# 🚀 SIMPAC - Sistema de Transferencia PGE

**Sistema de Gestión del Proceso de Transferencia según Plan de Implementación de la Presidencia de la Gestión Económica (PGE)**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38bdf8.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-PCM-green.svg)](#)

---

## 📋 Descripción

SIMPAC es un sistema web moderno desarrollado en Laravel para gestionar el **Proceso de Transferencia de funciones, recursos y responsabilidades** entre entidades, conforme al Plan de Implementación de la PGE vigente.

### 🎯 Objetivo Principal
Facilitar la ejecución ordenada de transferencias mediante la conformación de Órganos Colegiados, ejecución por componentes y formalización mediante actos resolutivos.

---

## ✨ Características Principales

### 📌 Actividad 1 - Registro de Plan de Implementación (✅ IMPLEMENTADO)
- ✅ Registro de Plan aprobado por **Resolución Ministerial**
- ✅ Subida de documentos PDF (Plan + Resolución)
- ✅ Control de **plan único activo** para todas las entidades
- ✅ Gestión de fechas de vigencia (inicio y fin)
- ✅ **Timeline histórica** de planes por año
- ✅ Registro de **entidades** establecidas en el plan
- ✅ Alta de **sectoristas/operarios** por Unidad de TI
- ✅ **Asignación de entidades** a sectoristas para seguimiento

### 🔄 Fases del Proceso (En desarrollo)
- **Fase 1**: Inicio y Planificación (7 días)
- **Fase 2**: Ejecución por Componentes (5 días)
- **Fase 3**: Validación y Cierre (6 días)

### 🛠️ Componentes de Ejecución
1. Presupuesto
2. Bienes y Servicios
3. Acervo Documentario
4. Tecnología de la Información
5. Recursos Humanos

---

## 🏗️ Arquitectura del Sistema

### Stack Tecnológico
- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Tailwind CSS 3.x
- **Base de Datos**: SQLite (desarrollo) / MySQL (producción)
- **Autenticación**: Sistema simple personalizado
- **File Storage**: Laravel Storage

### Estructura de Datos
```
IMPLEMENTATION_PLANS (Planes de Implementación)
    ├── ENTITIES (Entidades del Plan)
    │   └── ENTITY_ASSIGNMENTS (Asignaciones)
    │       └── SECTORISTAS (Responsables de Seguimiento)
```

---

## 🚀 Instalación Rápida

### Requisitos Previos
- PHP >= 8.2
- Composer
- Node.js & NPM
- XAMPP (o cualquier servidor con PHP)

### Pasos de Instalación

```bash
# 1. Clonar el repositorio
git clone [url-del-repositorio] simpac-laravel
cd simpac-laravel

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JavaScript
npm install

# 4. Configurar archivo .env
cp .env.example .env
php artisan key:generate

# 5. Ejecutar migraciones
php artisan migrate

# 6. Crear enlace simbólico para storage
php artisan storage:link

# 7. Compilar assets
npm run build

# 8. Iniciar servidor de desarrollo
php artisan serve
```

### Acceso al Sistema
```
URL: http://localhost:8000
Usuario: admin@simpac.gob.pe
Contraseña: password123
```

---

## 📚 Documentación

### Documentos Disponibles
- 📖 [**IMPLEMENTACION_ACTIVIDAD_1.md**](IMPLEMENTACION_ACTIVIDAD_1.md) - Documentación técnica completa
- 📘 [**GUIA_RAPIDA_ACTIVIDAD_1.md**](GUIA_RAPIDA_ACTIVIDAD_1.md) - Guía de usuario
- 📝 [**RESUMEN_IMPLEMENTACION.md**](RESUMEN_IMPLEMENTACION.md) - Resumen ejecutivo
- 📄 [**LEEME.md**](LEEME.md) - Instrucciones generales del proyecto

---

## 🗂️ Estructura del Proyecto

```
simpac-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── ImplementationPlanController.php  ✅
│   │   ├── EntityController.php              ✅
│   │   ├── SectoristaController.php          ✅
│   │   └── EntityAssignmentController.php    ✅
│   └── Models/
│       ├── ImplementationPlan.php            ✅
│       ├── Entity.php                        ✅
│       ├── Sectorista.php                    ✅
│       └── EntityAssignment.php              ✅
├── database/migrations/
│   ├── *_create_implementation_plans_table.php  ✅
│   ├── *_create_entities_table.php              ✅
│   ├── *_create_sectoristas_table.php           ✅
│   └── *_create_entity_assignments_table.php    ✅
├── resources/views/
│   ├── dashboard/
│   │   ├── implementation-plans/            ✅
│   │   ├── planning.blade.php               ✅
│   │   ├── execution.blade.php
│   │   └── validation.blade.php
│   └── layouts/
│       └── dashboard.blade.php              ✅
└── routes/
    └── web.php                              ✅
```

---

## 👥 Roles del Sistema

### Roles Implementados
- **Secretario de la CTPPGE**: Coordinador general del proceso
- **Órgano Colegiado**: Comité de aprobación
- **Responsables de Componentes**: Ejecutores por área
- **Procuraduría**: Validación legal
- **Sectoristas**: Responsables de seguimiento de entidades
- **Operarios**: Personal de apoyo
- **Unidad de TI**: Administración de sectoristas

---

## 🎨 Características de UI/UX

### Diseño
- ✅ Sidebar azul metálico corporativo
- ✅ Diseño responsive (mobile-first)
- ✅ Badges de estado con colores semánticos
- ✅ Iconos SVG profesionales
- ✅ Animaciones sutiles y transiciones

### Estados Visuales
- 🟢 **Verde**: Activo/Completado/Vigente
- 🔵 **Azul**: En Progreso/Modificado
- 🟡 **Amarillo**: Pendiente/Advertencia
- 🔴 **Rojo**: Expirado/Error/Cerrado
- ⚫ **Gris**: Inactivo/Suspendido

---

## 🔐 Seguridad

### Medidas Implementadas
- ✅ Protección CSRF en formularios
- ✅ Validación de inputs en servidor
- ✅ Autenticación personalizada
- ✅ Middleware de protección de rutas
- ✅ Soft deletes para recuperación de datos
- ✅ Sanitización de archivos PDF

---

## 📊 Base de Datos

### Tablas Principales
1. **implementation_plans** - Planes de implementación
2. **entities** - Entidades del plan
3. **sectoristas** - Responsables de seguimiento
4. **entity_assignments** - Asignaciones entidad-sectorista
5. **users** - Usuarios del sistema

### Relaciones
- Un plan → Múltiples entidades
- Una entidad → Múltiples asignaciones históricas
- Un sectorista → Múltiples entidades asignadas
- Una asignación activa por entidad

---

## 🔧 Comandos Útiles

```bash
# Desarrollo
php artisan serve              # Iniciar servidor
npm run dev                    # Compilar assets (watch)
php artisan migrate:fresh      # Refrescar BD

# Mantenimiento
php artisan cache:clear        # Limpiar caché
php artisan view:clear         # Limpiar vistas
php artisan config:clear       # Limpiar configuración

# Base de Datos
php artisan migrate            # Ejecutar migraciones
php artisan db:seed            # Ejecutar seeders
php artisan storage:link       # Crear enlace de storage
```

---

## 📈 Roadmap

### ✅ Fase 1A - Completado
- [x] Estructura base Laravel
- [x] Autenticación simple
- [x] Dashboard principal
- [x] Módulo de Planes de Implementación
- [x] Gestión de Entidades (modelo)
- [x] Gestión de Sectoristas (modelo)
- [x] Sistema de Asignaciones (modelo)

### 🔄 Fase 1B - En Desarrollo
- [ ] CRUD completo de Entidades
- [ ] CRUD completo de Sectoristas
- [ ] CRUD completo de Asignaciones
- [ ] Vista de Timeline gráfica
- [ ] Dashboard de Sectoristas
- [ ] Importación masiva (Excel/CSV)

### 📋 Fase 2 - Pendiente
- [ ] Actividad 2-5 de Fase 1
- [ ] Módulo de Componentes (Fase 2)
- [ ] Módulo de Validación (Fase 3)
- [ ] Sistema de Notificaciones
- [ ] Generación de Reportes
- [ ] Exportación a PDF/Excel

---

## 🐛 Solución de Problemas

### Problema: Error 404 en imágenes/PDFs
```bash
php artisan storage:link
```

### Problema: Estilos no se aplican
```bash
npm run build
php artisan view:clear
```

### Problema: Error de permisos
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 👨‍💻 Desarrollo

### Agregar Nueva Funcionalidad
```bash
# 1. Crear migración
php artisan make:migration create_table_name

# 2. Crear modelo
php artisan make:model ModelName

# 3. Crear controlador
php artisan make:controller ControllerName --resource

# 4. Agregar rutas en web.php
# 5. Crear vistas en resources/views/
```

---

## 📞 Soporte

### Contacto del Proyecto
- 📧 **Email**: soporte.simpac@pcm.gob.pe
- 📱 **Teléfono**: +51 (01) xxx-xxxx
- 🏢 **Organización**: Presidencia del Consejo de Ministros (PCM)

### Unidad de Tecnología
- 📧 **Email**: ti.simpac@pcm.gob.pe
- Para: Alta de sectoristas, problemas técnicos

---

## 📜 Licencia

© 2025 SIMPAC - Sistema de Transferencia PGE  
Presidencia del Consejo de Ministros - PCM  
Todos los derechos reservados.

---

## 🤝 Contribuciones

Este es un proyecto gubernamental interno. Las contribuciones están limitadas al equipo de desarrollo autorizado.

---

## 📝 Notas de Versión

### v1.0.0 - Actividad 1 Implementada (06/10/2025)
- ✅ Registro de Plan de Implementación con RM
- ✅ Gestión de Entidades del Plan
- ✅ Alta de Sectoristas por Unidad TI
- ✅ Sistema de Asignaciones
- ✅ Timeline histórica de planes
- ✅ Control de plan único activo

---

## 🔗 Enlaces Útiles

- [Documentación Laravel](https://laravel.com/docs)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [PHP Documentation](https://www.php.net/docs.php)

---

**Desarrollado con ❤️ para la Presidencia del Consejo de Ministros**

**Última actualización**: 6 de Octubre de 2025  
**Versión**: 1.0.0  
**Estado**: ✅ Producción - Actividad 1

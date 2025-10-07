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

Sistema web en Laravel para gestión del Proceso de Transferencia según Plan de Implementación PGE vigente.

## 📋 Características Principales

### ✨ Módulo de Planes de Implementación (Actividad 1)
- **Registro único de Plan de Implementación PGE**
- Aprobación mediante Resolución Directoral (RD)
- Subida de documentos en PDF
- Control de vigencia (fecha inicio y fin)
- **Solo un plan activo a la vez** - No puede haber 2 planes en curso
- Fecha fin se registra cuando se genera modificación/actualización
- Plan único para todas las entidades

#### Flujo del Plan
1. **Registrar Plan**: RD + PDF + Fecha Inicio
2. **Plan Activo**: Único vigente en el sistema
3. **Cerrar Plan**: Establece fecha fin automáticamente
4. **Nuevo Plan**: Solo después de cerrar el anterior

Ver documentación completa en: [`PLAN_IMPLEMENTACION.md`](PLAN_IMPLEMENTACION.md)

## 🎯 Fases del Proceso

### Fase 1: Inicio y Planificación
- Actividad 1: Registrar Plan de Implementación PGE ✅
- Actividad 2: Solicitar conformación del Órgano Colegiado
- Actividad 3: Recepcionar resolución de conformación
- Actividad 4: Coordinar reunión de inicio
- Actividad 5: Aprobar Plan de Trabajo preliminar

### Fase 2: Ejecución por Componentes
- Presupuesto
- Bienes y Servicios
- Acervo Documentario
- Tecnología de la Información
- Recursos Humanos

### Fase 3: Validación y Cierre
- Revisión y validación
- Suscripción de actas
- Acta de cierre final

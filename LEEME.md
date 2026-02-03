# 🚀 SIMPAC - Sistema de Transferencia PGE

Sistema web en Laravel para gestión del Proceso de Transferencia según Plan de Implementación PGE vigente.

## ⚡ Inicio Rápido (como React)

### Levantar el servidor (TODO EN UNO):
```bash
npm run dev
```

Este comando levanta automáticamente:
- ✅ Vite (assets, hot reload)
- ✅ Servidor Laravel (puerto 8001)

### Otros comandos útiles:

```bash
# Solo el servidor Laravel (sin Vite)
npm run serve

# Solo Vite (si ya tienes el servidor corriendo)
npm run dev:vite

# Compilar para producción
npm run build
```

## 🌐 Acceso al Sistema

### Local (Desarrollo en tu máquina):
- **URL Local (HTTP)**: http://localhost:8001 o http://127.0.0.1:8001
- ⚠️ **IMPORTANTE**: Usa `http://` (no `https://`) para acceso local

### Túnel de Desarrollo (Acceso Remoto):
- **URL Túnel (HTTPS)**: https://gvlcxbfb-8001.brs.devtunnels.ms/
- Permite acceso remoto desde cualquier lugar
- HTTPS nativo incluido
- Perfecto para compartir tu trabajo o probar en móviles
- Ver más detalles en [TUNNEL.md](TUNNEL.md)

## 👤 Usuarios de Prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Secretario CTPPGE** | secretario@simpac.com | secretario123 |
| **Procurador(a) PGE** | procurador@simpac.com | procurador123 |
| **Responsable de Componente** | responsable@simpac.com | responsable123 |
| **Órgano Colegiado** | colegiado@simpac.com | colegiado123 |

## 📋 Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js >= 18
- npm o yarn

## 🛠️ Instalación Inicial (Primera vez)

```bash
# 1. Instalar dependencias de PHP
composer install

# 2. Instalar dependencias de Node
npm install

# 3. Configurar variables de entorno
cp .env.example .env

# 4. Generar key de la aplicación
php artisan key:generate

# 5. Limpiar cache
php artisan config:clear
php artisan cache:clear

# 6. ¡Listo! Levantar el servidor
npm run dev
```

## ⚙️ Configuración

### Sin Base de Datos
Este proyecto está configurado para funcionar **SIN base de datos**:
- ✅ Usuarios hardcodeados en el controlador
- ✅ Sesiones en archivos
- ✅ Sin migraciones necesarias

### Con Base de Datos (Opcional - Futuro)
Si decides usar base de datos más adelante:
```bash
# 1. Configurar .env con tu BD
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=simpac
DB_USERNAME=root
DB_PASSWORD=

# 2. Ejecutar migraciones
php artisan migrate
```

## 📁 Estructura del Proyecto

```
simpac-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── SimpleAuthController.php  # Login sin BD
│   │   │   └── DashboardController.php   # Vistas del dashboard
│   │   └── Middleware/
│   │       └── SimpleAuth.php            # Middleware de autenticación
│   └── Models/                            # (No usados en esta versión)
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   └── simple-login.blade.php    # Página de login
│   │   ├── layouts/
│   │   │   └── dashboard.blade.php       # Layout principal
│   │   └── dashboard/                     # Vistas del sistema
│   ├── css/
│   │   └── app.css                       # Estilos Tailwind
│   └── js/
│       └── app.js                         # JavaScript
├── routes/
│   └── web.php                            # Rutas del sistema
├── doc1.txt                               # Documentación del flujo PGE
└── package.json                           # Scripts npm
```

## 🎨 Características

### Diseño Moderno
- ✅ Sidebar azul/morado metálico elegante
- ✅ Dashboard responsive
- ✅ Gradientes y animaciones suaves
- ✅ Diseño basado en Sales Dashboard (Figma)

### Flujo Completo del Proceso (según doc1.txt)
- ✅ **Fase 1**: Inicio y Planificación (7 días - 5 actividades)
- ✅ **Fase 2**: Ejecución por Componentes (5 días - 5 componentes)
- ✅ **Fase 3**: Validación y Cierre (6 días - 5 actividades)
- ✅ **Total**: 18 días hábiles

### 5 Componentes en Paralelo
1. Presupuesto
2. Bienes y Servicios
3. Acervo Documentario
4. Tecnología de la Información
5. Recursos Humanos

### Roles del Sistema
1. **Secretario CTPPGE** - Coordinador general
2. **Órgano Colegiado** - Aprobación de planes
3. **Responsables de Componentes** - Ejecutores
4. **Procuraduría** - Validación legal
5. **Entidad Receptora** - Receptor de funciones

## 🔧 Comandos Útiles

### Desarrollo
```bash
npm run dev          # Levantar TODO (Vite + Laravel)
npm run serve        # Solo Laravel
php artisan serve    # Laravel directamente
```

### Cache y Limpieza
```bash
php artisan config:clear    # Limpiar config
php artisan cache:clear     # Limpiar cache
php artisan route:clear     # Limpiar rutas
php artisan view:clear      # Limpiar vistas
```

### Producción
```bash
npm run build               # Compilar assets
php artisan config:cache    # Cachear config
php artisan route:cache     # Cachear rutas
php artisan view:cache      # Cachear vistas
```

## 🐛 Solución de Problemas

### El servidor no levanta
```bash
# Verificar si el puerto está ocupado
lsof -ti:8001

# Matar el proceso
kill -9 $(lsof -ti:8001)

# O usar otro puerto
php artisan serve --port=8000
```

### Error de permisos
```bash
chmod -R 775 storage bootstrap/cache
```

### Error "Class not found"
```bash
composer dump-autoload
php artisan config:clear
```

## 📝 Notas Importantes

- ✅ **Sin base de datos**: El sistema funciona completamente sin BD
- ✅ **Datos de prueba**: Los usuarios están hardcodeados
- ✅ **Producción**: Para producción, considera implementar base de datos real
- ✅ **Seguridad**: Las contraseñas de prueba son para desarrollo únicamente

## 🚀 Deploy (Futuro)

### Opciones recomendadas:
- Laravel Forge
- Laravel Vapor (Serverless)
- DigitalOcean App Platform
- Heroku
- AWS EC2

## 📄 Documentación Adicional

- **doc1.txt**: Flujo completo del proceso de transferencia PGE
- [Laravel Docs](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)

## 🎯 Próximos Pasos (Opcional)

1. Implementar base de datos real
2. Sistema de notificaciones
3. Generación de documentos PDF
4. Dashboard con estadísticas reales
5. Sistema de permisos por rol
6. Auditoría de cambios
7. Reportes y exportaciones

---

**Desarrollado con ❤️ usando Laravel + Tailwind CSS**

¿Necesitas ayuda? Revisa la documentación o contacta al equipo de desarrollo.

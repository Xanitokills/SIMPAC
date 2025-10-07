# 🌐 Configuración de Dev Tunnel

## Túnel Configurado
Tu aplicación está configurada para funcionar con el siguiente túnel de desarrollo:

**URL del Túnel:** `https://gvlcxbfb-8001.brs.devtunnels.ms/`

## ✅ Configuración Aplicada

### 1. Variables de Entorno (.env)
```env
APP_URL=https://gvlcxbfb-8001.brs.devtunnels.ms
```

### 2. Forzar HTTPS en URLs
El archivo `AppServiceProvider.php` ahora fuerza el esquema HTTPS cuando detecta que se está usando un túnel de desarrollo:

```php
if (config('app.env') === 'local' && str_contains(config('app.url'), 'devtunnels.ms')) {
    \Illuminate\Support\Facades\URL::forceScheme('https');
}
```

## 🚀 Cómo Usar

### Opción 1: Usar npm run dev (Recomendado)
```bash
npm run dev
```
Este comando levanta tanto Vite como el servidor Laravel en el puerto 8001.

### Opción 2: Levantar el servidor manualmente
```bash
php artisan serve --port=8001
```

## 🔐 Acceso al Sistema

Una vez que el servidor esté corriendo:

1. **Login desde el túnel:**
   - Accede a: `https://gvlcxbfb-8001.brs.devtunnels.ms/login`
   - Después del login exitoso, serás redirigido automáticamente a: `https://gvlcxbfb-8001.brs.devtunnels.ms/dashboard`

2. **Usuarios de Prueba:**
   - **Secretario CTPPGE**
     - Email: `secretario@simpac.com`
     - Password: `secretario123`
   
   - **Procurador(a) PGE**
     - Email: `procurador@simpac.com`
     - Password: `procurador123`
   
   - **Responsable de Componente**
     - Email: `responsable@simpac.com`
     - Password: `responsable123`
   
   - **Miembro Órgano Colegiado**
     - Email: `colegiado@simpac.com`
     - Password: `colegiado123`

## 🔄 Flujo de Redirección

```
https://gvlcxbfb-8001.brs.devtunnels.ms/
  ↓
https://gvlcxbfb-8001.brs.devtunnels.ms/login
  ↓ (después de login exitoso)
https://gvlcxbfb-8001.brs.devtunnels.ms/dashboard
```

## 📝 Notas Importantes

1. **HTTPS Automático:** Todos los enlaces y formularios ahora usarán HTTPS automáticamente
2. **Assets:** Los assets de Vite se cargarán correctamente desde el túnel
3. **Sesiones:** Las sesiones funcionan normalmente con el túnel
4. **CSRF:** Los tokens CSRF están configurados y funcionan correctamente

## 🛠️ Cambiar el Túnel

Si necesitas usar un túnel diferente, simplemente actualiza el valor de `APP_URL` en el archivo `.env`:

```env
APP_URL=https://tu-nuevo-tunnel.devtunnels.ms
```

Luego reinicia el servidor:
```bash
# Si estás usando npm run dev, presiona Ctrl+C y ejecuta de nuevo
npm run dev
```

## 🎯 Ventajas del Túnel

✅ Acceso remoto desde cualquier lugar  
✅ Compartir tu desarrollo con otros  
✅ Probar en dispositivos móviles  
✅ HTTPS nativo (sin certificados locales)  
✅ URLs públicas temporales  

---

**Desarrollado con ❤️ para SIMPAC - Sistema de Transferencia PGE**

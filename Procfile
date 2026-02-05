web: echo "🚀 Iniciando SIMPAC..." && \
     echo "📦 PHP Version: $(php -v | head -n 1)" && \
     echo "📂 Creando directorios..." && \
     mkdir -p database && \
     mkdir -p storage/framework/sessions && \
     mkdir -p storage/framework/views && \
     mkdir -p storage/framework/cache && \
     mkdir -p storage/logs && \
     chmod -R 775 storage bootstrap/cache && \
     touch database/database.sqlite && \
     echo "✅ Base de datos creada" && \
     echo "🔧 Limpiando cachés..." && \
     php artisan config:clear && \
     php artisan cache:clear && \
     php artisan view:clear && \
     php artisan route:clear && \
     echo "🗃️ Ejecutando migraciones..." && \
     php artisan migrate --force 2>&1 && \
     echo "✅ Migraciones completadas" && \
     echo "🌱 Ejecutando seeder..." && \
     php artisan db:seed --force --class=ProductionSeeder 2>&1 && \
     echo "✅ Seeder completado" && \
     echo "⚡ Optimizando aplicación..." && \
     php artisan config:cache && \
     php artisan route:cache && \
     php artisan view:cache && \
     echo "✅ Optimización completada" && \
     echo "🌐 Iniciando servidor en puerto ${PORT:-8080}..." && \
     php artisan serve --host=0.0.0.0 --port=${PORT:-8080} --tries=0

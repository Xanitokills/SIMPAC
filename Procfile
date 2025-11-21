web: echo "🚀 Iniciando SIMPAC..." && \
     mkdir -p database && \
     mkdir -p storage/framework/sessions && \
     mkdir -p storage/framework/views && \
     mkdir -p storage/framework/cache && \
     chmod -R 775 storage && \
     touch database/database.sqlite && \
     echo "✅ Base de datos creada" && \
     php artisan migrate --force && \
     echo "✅ Migraciones completadas" && \
     php artisan db:seed --force --class=ProductionSeeder && \
     echo "✅ Seeder completado" && \
     php artisan view:clear && \
     php artisan route:cache && \
     echo "🌐 Iniciando servidor en puerto ${PORT:-8080}..." && \
     php artisan serve --host=0.0.0.0 --port=${PORT:-8080}

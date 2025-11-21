web: echo "🚀 Iniciando SIMPAC..." && \
     mkdir -p database && \
     touch database/database.sqlite && \
     echo "✅ Base de datos creada" && \
     php artisan migrate --force && \
     echo "✅ Migraciones completadas" && \
     php artisan db:seed --force --class=ProductionSeeder && \
     echo "✅ Seeder completado" && \
     php artisan config:cache && \
     php artisan route:cache && \
     echo "🌐 Iniciando servidor en puerto ${PORT:-8080}..." && \
     php artisan serve --host=0.0.0.0 --port=${PORT:-8080}

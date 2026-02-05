<?php
/**
 * Script de diagnóstico para Railway
 * Verifica que todos los componentes estén funcionando correctamente
 */

echo "=== RAILWAY HEALTH CHECK ===\n\n";

// 1. Verificar versión de PHP
echo "✓ PHP Version: " . phpversion() . "\n";

// 2. Verificar extensiones requeridas
$required_extensions = ['pdo', 'pdo_sqlite', 'mbstring', 'openssl', 'json'];
echo "\n✓ Extensiones PHP:\n";
foreach ($required_extensions as $ext) {
    $loaded = extension_loaded($ext);
    echo "  " . ($loaded ? "✓" : "✗") . " $ext: " . ($loaded ? "Cargada" : "NO CARGADA") . "\n";
}

// 3. Verificar directorios
echo "\n✓ Directorios:\n";
$directories = [
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/framework/cache',
    'storage/logs',
    'bootstrap/cache',
    'database'
];
foreach ($directories as $dir) {
    $exists = is_dir($dir);
    $writable = is_writable($dir);
    echo "  " . ($exists && $writable ? "✓" : "✗") . " $dir: ";
    if (!$exists) {
        echo "NO EXISTE\n";
    } elseif (!$writable) {
        echo "NO ESCRIBIBLE\n";
    } else {
        echo "OK\n";
    }
}

// 4. Verificar base de datos SQLite
echo "\n✓ Base de datos:\n";
$db_path = 'database/database.sqlite';
if (file_exists($db_path)) {
    echo "  ✓ database.sqlite existe\n";
    echo "  ✓ Tamaño: " . filesize($db_path) . " bytes\n";
    echo "  ✓ Permisos: " . substr(sprintf('%o', fileperms($db_path)), -4) . "\n";
} else {
    echo "  ✗ database.sqlite NO EXISTE\n";
}

// 5. Verificar .env
echo "\n✓ Configuración:\n";
if (file_exists('.env')) {
    echo "  ✓ .env existe\n";
} else {
    echo "  ✗ .env NO EXISTE\n";
}

// 6. Verificar puerto
$port = getenv('PORT') ?: '8080';
echo "\n✓ Puerto configurado: $port\n";

// 7. Verificar memoria
echo "\n✓ Memoria:\n";
echo "  ✓ Límite: " . ini_get('memory_limit') . "\n";
echo "  ✓ Uso actual: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB\n";

echo "\n=== FIN DEL HEALTH CHECK ===\n";

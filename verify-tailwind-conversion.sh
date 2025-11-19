#!/bin/bash

# Script de verificación para la vista JIRA (manage.blade.php)

echo "🔍 Verificación de Vista JIRA - Conversión Bootstrap a Tailwind"
echo "================================================================"
echo ""

# Verificar que el archivo existe
if [ -f "resources/views/dashboard/execution/action-plans/manage.blade.php" ]; then
    echo "✅ Archivo manage.blade.php existe"
else
    echo "❌ Archivo manage.blade.php NO encontrado"
    exit 1
fi

# Verificar que el backup existe
if [ -f "resources/views/dashboard/execution/action-plans/manage-bootstrap-backup.blade.php" ]; then
    echo "✅ Backup de Bootstrap creado correctamente"
else
    echo "⚠️  No se encontró el backup de Bootstrap"
fi

echo ""
echo "📋 Verificando que NO hay referencias a Bootstrap..."
echo ""

# Buscar referencias a Bootstrap (no debería haber)
BOOTSTRAP_COUNT=$(grep -i "bootstrap" resources/views/dashboard/execution/action-plans/manage.blade.php | wc -l | tr -d ' ')

if [ "$BOOTSTRAP_COUNT" -eq "0" ]; then
    echo "✅ No hay referencias a Bootstrap"
else
    echo "❌ Se encontraron $BOOTSTRAP_COUNT referencias a Bootstrap:"
    grep -n -i "bootstrap" resources/views/dashboard/execution/action-plans/manage.blade.php
fi

echo ""
echo "📋 Verificando uso de Tailwind CSS..."
echo ""

# Buscar clases comunes de Tailwind
TAILWIND_CLASSES=("bg-white" "rounded-lg" "shadow" "flex" "grid" "px-" "py-" "text-")
TAILWIND_FOUND=0

for class in "${TAILWIND_CLASSES[@]}"; do
    COUNT=$(grep -o "$class" resources/views/dashboard/execution/action-plans/manage.blade.php | wc -l | tr -d ' ')
    if [ "$COUNT" -gt "0" ]; then
        TAILWIND_FOUND=$((TAILWIND_FOUND + 1))
    fi
done

if [ "$TAILWIND_FOUND" -ge "5" ]; then
    echo "✅ Se detectaron clases de Tailwind CSS"
else
    echo "❌ No se detectaron suficientes clases de Tailwind"
fi

echo ""
echo "📋 Verificando estructura de componentes..."
echo ""

# Verificar componentes clave
COMPONENTS=("editable-cell" "view-mode" "edit-mode" "saveAllBtn" "searchInput" "filterSection" "filterStatus")
MISSING_COMPONENTS=()

for component in "${COMPONENTS[@]}"; do
    if grep -q "$component" resources/views/dashboard/execution/action-plans/manage.blade.php; then
        echo "✅ Componente '$component' presente"
    else
        echo "❌ Componente '$component' FALTA"
        MISSING_COMPONENTS+=("$component")
    fi
done

echo ""
echo "📋 Verificando funciones JavaScript..."
echo ""

# Verificar funciones JS clave
JS_FUNCTIONS=("enterEditMode" "exitEditMode" "applyFilters" "showNotification")
MISSING_FUNCTIONS=()

for func in "${JS_FUNCTIONS[@]}"; do
    if grep -q "$func" resources/views/dashboard/execution/action-plans/manage.blade.php; then
        echo "✅ Función JS '$func' presente"
    else
        echo "❌ Función JS '$func' FALTA"
        MISSING_FUNCTIONS+=("$func")
    fi
done

echo ""
echo "📋 Verificando rutas del controlador..."
echo ""

# Verificar que las rutas están correctas
ROUTES=("execution.action-plans.show" "execution.action-plans.items" "execution.action-plans.items.download-file")
MISSING_ROUTES=()

for route in "${ROUTES[@]}"; do
    if grep -q "$route" resources/views/dashboard/execution/action-plans/manage.blade.php; then
        echo "✅ Ruta '$route' presente"
    else
        echo "❌ Ruta '$route' FALTA"
        MISSING_ROUTES+=("$route")
    fi
done

echo ""
echo "================================================================"
echo "📊 RESUMEN DE VERIFICACIÓN"
echo "================================================================"
echo ""

# Resumen final
ERRORS=0

if [ "$BOOTSTRAP_COUNT" -ne "0" ]; then
    echo "❌ Hay referencias a Bootstrap pendientes de eliminar"
    ERRORS=$((ERRORS + 1))
fi

if [ "$TAILWIND_FOUND" -lt "5" ]; then
    echo "❌ No se detectaron clases de Tailwind"
    ERRORS=$((ERRORS + 1))
fi

if [ "${#MISSING_COMPONENTS[@]}" -ne "0" ]; then
    echo "❌ Faltan componentes: ${MISSING_COMPONENTS[*]}"
    ERRORS=$((ERRORS + 1))
fi

if [ "${#MISSING_FUNCTIONS[@]}" -ne "0" ]; then
    echo "❌ Faltan funciones JS: ${MISSING_FUNCTIONS[*]}"
    ERRORS=$((ERRORS + 1))
fi

if [ "${#MISSING_ROUTES[@]}" -ne "0" ]; then
    echo "❌ Faltan rutas: ${MISSING_ROUTES[*]}"
    ERRORS=$((ERRORS + 1))
fi

echo ""
if [ "$ERRORS" -eq "0" ]; then
    echo "✅ TODAS LAS VERIFICACIONES PASARON"
    echo ""
    echo "🚀 Próximo paso: Probar en el navegador"
    echo "   URL: http://localhost/dashboard/execution/action-plans/[ID]/manage"
    echo ""
    echo "🧪 Verificar:"
    echo "   1. No hay errores en la consola del navegador"
    echo "   2. La tabla se renderiza correctamente"
    echo "   3. Los filtros funcionan"
    echo "   4. La edición inline funciona"
    echo "   5. El botón 'Guardar Cambios' persiste los datos"
    exit 0
else
    echo "❌ SE ENCONTRARON $ERRORS ERRORES"
    echo "Por favor, revisar los problemas indicados arriba."
    exit 1
fi

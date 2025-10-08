<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPAC - Inicio de Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .logo-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="login-card rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Logo y Título -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold logo-text mb-2">SIMPAC</h1>
            <p class="text-gray-600 text-sm">Sistema de Gestión de Transferencias</p>
        </div>

        <!-- Mensajes de error/éxito -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de Login -->
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Correo Electrónico
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                    placeholder="usuario@simpac.com"
                    value="{{ old('email') }}"
                >
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                    placeholder="••••••••"
                >
            </div>

            <!-- Botón de Login -->
            <button 
                type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-lg hover:from-purple-700 hover:to-indigo-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
            >
                Iniciar Sesión
            </button>
        </form>

        <!-- Usuarios de Prueba - Roles del Sistema -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-xs text-gray-500 font-semibold mb-3 text-center">USUARIOS DE PRUEBA - ROLES DEL SISTEMA:</p>
            <div class="space-y-2 text-xs max-h-96 overflow-y-auto pr-2">
                <!-- Admin -->
                <div class="bg-red-50 p-3 rounded-lg border border-red-200">
                    <p class="font-semibold text-red-800">👑 Administrador</p>
                    <p class="text-red-600 text-[10px] mb-1">Acceso total al sistema - Puede ver y editar todo</p>
                    <p class="text-gray-700">Email: <span class="font-mono">admin@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">admin123</span></p>
                </div>

                <!-- Secretario CTPPGE -->
                <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                    <p class="font-semibold text-blue-800">🎯 Secretario CTPPGE</p>
                    <p class="text-blue-600 text-[10px] mb-1">Coordinador general - Puede editar Actividad 1</p>
                    <p class="text-gray-700">Email: <span class="font-mono">secretario@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">secretario123</span></p>
                </div>

                <!-- Procurador PGE -->
                <div class="bg-purple-50 p-3 rounded-lg border border-purple-200">
                    <p class="font-semibold text-purple-800">⚖️ Procurador(a) PGE</p>
                    <p class="text-purple-600 text-[10px] mb-1">Validación legal - Ve todos los módulos</p>
                    <p class="text-gray-700">Email: <span class="font-mono">procurador@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">procurador123</span></p>
                </div>

                <!-- Sectoristas -->
                <div class="bg-indigo-50 p-3 rounded-lg border border-indigo-200">
                    <p class="font-semibold text-indigo-800">👥 Sectorista 1 - Juan Carlos Pérez</p>
                    <p class="text-indigo-600 text-[10px] mb-1">4 entidades asignadas (MEF, SUNAT, Arequipa, etc.)</p>
                    <p class="text-gray-700">Email: <span class="font-mono">juan.perez@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">sectorista123</span></p>
                </div>

                <div class="bg-indigo-50 p-3 rounded-lg border border-indigo-200">
                    <p class="font-semibold text-indigo-800">👥 Sectorista 2 - María Rodríguez</p>
                    <p class="text-indigo-600 text-[10px] mb-1">4 entidades asignadas (MINEDU, RENIEC, Cusco, etc.)</p>
                    <p class="text-gray-700">Email: <span class="font-mono">maria.rodriguez@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">sectorista123</span></p>
                </div>

                <div class="bg-indigo-50 p-3 rounded-lg border border-indigo-200">
                    <p class="font-semibold text-indigo-800">👥 Sectorista 3 - Carlos Mendoza</p>
                    <p class="text-indigo-600 text-[10px] mb-1">4 entidades asignadas (MINSA, INDECOPI, Piura, etc.)</p>
                    <p class="text-gray-700">Email: <span class="font-mono">carlos.mendoza@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">sectorista123</span></p>
                </div>

                <!-- Responsable de Componente -->
                <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                    <p class="font-semibold text-green-800">◆ Responsable de Componente</p>
                    <p class="text-green-600 text-[10px] mb-1">Ejecutor de componentes específicos</p>
                    <p class="text-gray-700">Email: <span class="font-mono">responsable@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">responsable123</span></p>
                </div>

                <!-- Órgano Colegiado -->
                <div class="bg-orange-50 p-3 rounded-lg border border-orange-200">
                    <p class="font-semibold text-orange-800">◆ Órgano Colegiado</p>
                    <p class="text-orange-600 text-[10px] mb-1">Aprobación de planes y validación</p>
                    <p class="text-gray-700">Email: <span class="font-mono">colegiado@simpac.com</span></p>
                    <p class="text-gray-700">Contraseña: <span class="font-mono">colegiado123</span></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} SIMPAC. Versión de Desarrollo
            </p>
        </div>
    </div>

    <!-- Botón flotante de información (opcional) -->
    <div class="fixed bottom-4 right-4">
        <button 
            onclick="alert('Sistema en modo desarrollo\n\nNo se requiere base de datos.\nUsa las credenciales mostradas para acceder.')"
            class="bg-white text-purple-600 rounded-full p-3 shadow-lg hover:shadow-xl transition"
            title="Información"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </button>
    </div>
</body>
</html>

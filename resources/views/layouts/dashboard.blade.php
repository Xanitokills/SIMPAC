<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SIMPAC - Sistema de Transferencia PGE' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-blue: #3B82F6;
            --primary-blue-dark: #2563EB;
            --secondary-gray: #F8FAFC;
            --text-primary: #1E293B;
            --text-secondary: #64748B;
            --border-color: #E2E8F0;
            --success-green: #10B981;
            --warning-orange: #F59E0B;
            --danger-red: #EF4444;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        
        .main-content {
            flex: 1;
            transition: margin-left 0.3s ease;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .status-badge {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium;
        }
        
        .status-pending { @apply bg-yellow-100 text-yellow-800; }
        .status-progress { @apply bg-blue-100 text-blue-800; }
        .status-completed { @apply bg-green-100 text-green-800; }
        .status-delayed { @apply bg-red-100 text-red-800; }
        
        /* Custom Scrollbar - Azul metálico profesional */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(30, 58, 95, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #2563eb);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #1d4ed8);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar con diseño profesional azul metálico corporativo -->
        <aside id="sidebar" class="sidebar bg-gradient-to-b from-[#1e3a5f] via-[#2c4f7c] to-[#1a2f4d] shadow-2xl flex flex-col border-r border-blue-800/30">
            <!-- Logo Section -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-slate-700/50 bg-gradient-to-r from-[#1a2f4d] to-[#2c4f7c]/80">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center shadow-lg ring-2 ring-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">SIMPAC</h1>
                </div>
                <button id="sidebar-close" class="lg:hidden p-2 rounded-lg hover:bg-white/5 text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
                <!-- Dashboard Overview -->
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v3H8V5z"/>
                    </svg>
                    <span>Panel Principal</span>
                </a>

                <!-- Process Phases -->
                <div class="pt-6">
                    <h3 class="px-3 mb-3 text-[10px] font-bold text-blue-300/80 uppercase tracking-widest">Fases del Proceso</h3>
                    
                    <a href="{{ route('dashboard.planning') }}" class="nav-item {{ request()->routeIs('dashboard.planning') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span class="flex-1">Actividades previas</span>
                        <span class="text-[10px] bg-blue-500/20 text-blue-300 px-2 py-0.5 rounded-full font-medium">7d</span>
                    </a>

                    <a href="{{ route('dashboard.execution') }}" class="nav-item {{ request()->routeIs('dashboard.execution') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span class="flex-1">Ejecución por Componentes</span>
                        <span class="text-[10px] bg-green-500/20 text-green-300 px-2 py-0.5 rounded-full font-medium">5d</span>
                    </a>

                    <a href="{{ route('dashboard.validation') }}" class="nav-item {{ request()->routeIs('dashboard.validation') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="flex-1">Validación y Cierre</span>
                        <span class="text-[10px] bg-purple-500/20 text-purple-300 px-2 py-0.5 rounded-full font-medium">6d</span>
                    </a>
                </div>

                <!-- Management Tools -->
                <div class="pt-6">
                    <h3 class="px-3 mb-3 text-[10px] font-bold text-blue-300/80 uppercase tracking-widest">Herramientas</h3>
                    
                    <a href="{{ route('implementation-plans.index') }}" class="nav-item {{ request()->routeIs('implementation-plans.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Planes de Implementación</span>
                    </a>
                </div>
            </nav>

            <!-- User Section -->
            <div class="p-6 border-t border-slate-700/50 bg-gradient-to-r from-[#1a2f4d]/90 to-[#2c4f7c]/50">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-700 rounded-full flex items-center justify-center shadow-lg ring-2 ring-blue-500/40">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-white">{{ session('user_name', 'Usuario') }}</p>
                        <p class="text-xs text-blue-200/80">{{ session('user_role', 'Sistema PGE') }}</p>
                    </div>
                </div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content flex flex-col overflow-hidden">
            <!-- Header profesional -->
            <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="sidebar-toggle" class="lg:hidden p-2.5 rounded-lg hover:bg-gray-100 text-gray-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">
                                @yield('page-title', 'Dashboard')
                            </h2>
                            <p class="text-sm text-gray-500 mt-0.5">@yield('page-description', 'Sistema de Transferencia según Plan de Implementación PGE')</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <!-- Notifications -->
                        <button class="p-2.5 rounded-lg hover:bg-gray-100 transition-colors relative group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                        </button>
                        
                        <!-- Settings -->
                        <button class="p-2.5 rounded-lg hover:bg-gray-100 transition-colors group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarClose = document.getElementById('sidebar-close');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
        }

        sidebarToggle?.addEventListener('click', openSidebar);
        sidebarClose?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Active navigation highlighting - Estilo corporativo azul metálico
        document.querySelectorAll('.nav-item').forEach(item => {
            if (item.classList.contains('active')) {
                item.classList.add(
                    'bg-gradient-to-r', 'from-blue-600/30', 'to-blue-700/30',
                    'text-white', 'border-l-4', 'border-blue-400',
                    'shadow-lg', 'shadow-blue-500/20', 'font-semibold'
                );
            } else {
                item.classList.add(
                    'text-blue-100/90', 'hover:bg-white/10',
                    'hover:text-white', 'hover:border-l-4', 'hover:border-blue-400/50',
                    'border-l-4', 'border-transparent'
                );
            }
            item.classList.add(
                'flex', 'items-center', 'gap-3', 'px-4', 'py-3',
                'text-sm', 'font-medium', 'rounded-lg',
                'transition-all', 'duration-200', 'group'
            );
        });
    </script>

    @stack('scripts')
</body>
</html>

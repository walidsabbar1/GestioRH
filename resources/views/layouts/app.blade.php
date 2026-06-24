<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="RH Manager — Application de Gestion des Ressources Humaines">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RH Manager') — RH Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Mobile overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm lg:hidden" style="display: none;"></div>

    {{-- Main Content --}}
    <div class="main-content">
        {{-- Header --}}
        <header class="main-header">
            <div class="flex items-center gap-4">
                <button id="mobile-menu-open" class="mobile-menu-btn p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <h2 class="text-lg font-bold" style="color: var(--color-text);">@yield('page-title')</h2>
                    <p class="text-xs" style="color: var(--color-text-light);">@yield('page-subtitle')</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 px-3 py-2 rounded-xl" style="background: var(--color-bg);">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-xs font-bold" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium" style="color: var(--color-text);">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="main-body">
            {{-- Toast Notifications --}}
            @include('components.toast')

            @yield('content')
        </main>
    </div>
</body>
</html>

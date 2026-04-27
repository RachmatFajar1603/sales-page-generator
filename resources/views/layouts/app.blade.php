<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - AI Sales Page Generator</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white min-h-screen">

    {{-- Navbar --}}
    <nav class="border-b border-white/10 bg-gray-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-violet-500 to-indigo-600 rounded-lg flex items-center justify-center text-sm font-bold">
                        AI
                    </div>
                    <span class="font-semibold text-white">SalesGen</span>
                </a>

                {{-- Nav Links --}}
                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}"
                       class="text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 hover:text-white' }} transition-colors">
                        Dashboard
                    </a>
                    <a href="{{ route('generate.create') }}"
                       class="text-sm {{ request()->routeIs('generate.*') ? 'text-white' : 'text-gray-400 hover:text-white' }} transition-colors">
                        Generate
                    </a>
                    <a href="{{ route('sales-pages.history') }}"
                       class="text-sm {{ request()->routeIs('sales-pages.*') ? 'text-white' : 'text-gray-400 hover:text-white' }} transition-colors">
                        History
                    </a>
                </div>

                {{-- User Menu --}}
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-400">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm text-gray-400 hover:text-white border border-white/10 hover:border-white/30 px-3 py-1.5 rounded-lg transition-all">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div id="flash-success" class="fixed top-20 right-4 z-50 bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-xl text-sm backdrop-blur-md max-w-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <script>
        // Auto hide flash message
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) flash.style.display = 'none';
        }, 3000);
    </script>
</body>
</html>
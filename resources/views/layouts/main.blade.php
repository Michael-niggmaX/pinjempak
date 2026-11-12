<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinjemPak - SMK Negeri 5 Surakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-custom-orange { background-color: #FF8C5F; }
        .text-custom-orange { color: #FF8C5F; }
        .hover-custom-orange:hover { background-color: #e67a50; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex overflow-hidden text-gray-800 relative">

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden transition-opacity" onclick="toggleSidebar()"></div>

    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-custom-orange text-white flex flex-col justify-between py-6 px-4 h-full shadow-xl z-40 shrink-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
        <div>
            <div class="flex justify-between items-center mb-8 px-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3 hover:opacity-90 transition-opacity">
                    <img src="{{ asset('images/pinjempak2.svg') }}" alt="Logo" class="w-12 h-12 md:w-35 md:h-30 object-contain">
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-wide">PinjemPak</h1>
                </a>
                
                <button class="md:hidden text-white focus:outline-none" onclick="toggleSidebar()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-1 text-sm">
                <a href="{{ route('home') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <a href="{{ route('riwayat') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Riwayat
                </a>
                <a href="{{ route('pending') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Pending
                </a>
                
                @auth
                    @if(Auth::user()->role === 'petugas')
                        <a href="{{ route('users.index') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            Kelola User
                        </a>
                        <a href="{{ route('laporan') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Laporan
                        </a>
                    @else
                        <a href="{{ route('kembalikan') }}" class="px-4 py-3 rounded-xl hover:bg-white/20 transition-colors flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                            Kembalikan
                        </a>
                    @endif
                @endauth
            </nav>
        </div>

        @auth
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-sm hover:bg-white/20 w-full text-left px-4 py-3 rounded-xl transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log Out
            </button>
        </form>
        @endauth
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-y-auto relative w-full">
        
        <header class="flex justify-between items-center px-4 md:px-8 py-4 bg-white border-b border-gray-100 shrink-0 sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button class="md:hidden text-gray-600 focus:outline-none" onclick="toggleSidebar()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 leading-tight">Sistem Peminjaman Inventaris</h2>
                    <p class="text-xs md:text-sm text-gray-500 hidden sm:block">SMK Negeri 5 Surakarta</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 md:gap-3 hover:opacity-80 transition-opacity cursor-pointer">
                <div class="text-right">
                    @auth
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-custom-orange font-medium hover:underline">Login</a>
                    @endauth
                </div>
                <div class="h-9 w-9 md:h-10 md:w-10 bg-gray-800 rounded-full flex items-center justify-center text-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                </a>
            </div>
        </header>

        <div class="px-4 md:px-8 py-6 flex-1 pb-28">
            @yield('content')
        </div>

        @auth
            @if(request()->routeIs('home') && Auth::user()->role === 'petugas')
            <a href="{{ route('create') }}" class="fixed bottom-20 md:bottom-24 right-4 md:right-8 bg-custom-orange w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center shadow-lg hover:bg-orange-500 hover:scale-105 transition-all z-40 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </a>
            @endif
        @endauth

    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
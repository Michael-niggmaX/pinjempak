<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PinjemPak - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .bg-custom-orange { background-color: #FF8C5F; }
        .text-custom-orange { color: #FF8C5F; }
    </style>
</head>
<body class="h-screen flex overflow-hidden bg-white">
    <aside class="hidden md:flex w-72 lg:w-80 bg-custom-orange text-white flex-col py-8 px-8 h-full shrink-0">
        <h1 class="text-4xl font-normal mb-16">PinjemPak</h1>

        <div class="text-center mb-16">
            <p class="text-2xl leading-snug">
                Sistem<br>
                Peminjaman<br>
                Inventaris SMK N<br>
                5 Surakarta
            </p>
        </div>

        <div class="border-t border-white/50 mb-8"></div>

        <div class="flex flex-col space-y-4 text-xl">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Mudah</span>
            </div>
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Simpel</span>
            </div>
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Aman</span>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-full overflow-y-auto">
        
        <div class="md:hidden bg-custom-orange text-white p-6 text-center shrink-0">
            <h1 class="text-3xl font-semibold mb-1">PinjemPak</h1>
            <p class="text-sm opacity-90">Sistem Peminjaman Inventaris SMK N 5 Surakarta</p>
        </div>

        <header class="hidden md:block px-10 pt-8 pb-4 border-b-2 border-black shrink-0">
            <h2 class="text-3xl font-medium text-black">Sistem Peminjaman Inventaris</h2>
            <p class="text-lg text-gray-800">SMK Negeri 5 Surakarta</p>
        </header>

        <div class="flex-1 flex items-center justify-center p-4 md:p-10">
            @yield('content')
        </div>
    </main>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pengaduan</title>
    
    <!-- Memanggil TailwindCSS dan JS bawaan Laravel Breeze -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Memanggil FontAwesome untuk icon-icon (amplop, lonceng, dll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <!-- ================= SIDEBAR KIRI ================= -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">
            <!-- Logo / Judul Aplikasi -->
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <h1 class="text-lg font-bold">
                    <i class="fas fa-bullhorn mr-2 text-blue-400"></i> Sistem Pengaduan
                </h1>
            </div>
            
            <!-- Menu Navigasi -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- Menu Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 bg-gray-800 rounded hover:bg-gray-700 transition">
                    <i class="fas fa-tachometer-alt w-6 text-gray-400"></i> Dashboard
                </a>
                
                <!-- Menu Pengaduan (Contoh) -->
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-800 rounded text-gray-400 transition">
                    <i class="fas fa-envelope-open-text w-6"></i> Data Pengaduan
                </a>

                <!-- Menu Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-8 border-t border-gray-700 pt-4">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-600 rounded text-red-400 transition">
                        <i class="fas fa-sign-out-alt w-6"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- ================= AREA KANAN (KONTEN) ================= -->
        <div class="flex-1 flex flex-col w-full">
            
            <!-- TOPBAR ATAS -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <!-- Tempat Judul Halaman Dinamis -->
                <h2 class="text-xl font-semibold text-gray-800">
                    @yield('title', 'Dashboard')
                </h2>
                
                <!-- Profil Admin -->
                <div class="flex items-center gap-4">
                    <button class="text-gray-400 hover:text-gray-600 relative">
                        <i class="fas fa-bell text-lg"></i>
                        <!-- Notif merah -->
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <!-- Badge Role -->
                        <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded font-bold uppercase">
                            {{ Auth::user()->role ?? 'Admin' }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- KONTEN DINAMIS (Halaman lain akan muncul di sini) -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Notifikasi Sukses (jika ada) -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Ini tempat kode halaman dashboard/user dimasukkan -->
                @yield('content')
            </main>
            
        </div>
    </div>
</body>
</html>
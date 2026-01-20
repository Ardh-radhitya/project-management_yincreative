<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
        <title>Dashboard - Y.in Creative</title>

        @include('layout.partial.link')
        @stack('styles')

    </head>

        {{-- ================================================== --}}
        {{-- [PATCH] SIDEBAR MOBILE (Solusi Anti-Build) --}}
        {{-- ================================================== --}}

        {{-- 1. TOMBOL MENU FLOATING (Cuma muncul di layar HP/Tablet) --}}
        <button id="mobile-menu-btn" onclick="toggleMobileSidebar()"
                style="display: none; position: fixed; top: 20px; right: 20px; z-index: 9999; background: white; border: none; padding: 10px 14px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.2); cursor: pointer;">
            {{-- Ikon Garis Tiga (Hamburger) --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#344767" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        {{-- 2. BACKDROP (Latar Gelap saat menu kebuka) --}}
        <div id="mobile-backdrop" onclick="closeMobileSidebar()"
            style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); z-index: 9990; backdrop-filter: blur(2px);">
        </div>

        {{-- 3. STYLE & SCRIPT PENGENDALI --}}
        <script>
            function toggleMobileSidebar() {
                // Cari Sidebar: Coba cari ID 'sidenav-main', kalau gak ada cari tag 'aside'
                let sidebar = document.getElementById('sidenav-main') || document.querySelector('aside');
                let backdrop = document.getElementById('mobile-backdrop');

                if (sidebar) {
                    // Cek apakah sidebar lagi kebuka?
                    let isOpen = sidebar.style.transform === 'translateX(0%)';

                    if (isOpen) {
                        // Tutup
                        sidebar.style.transform = 'translateX(-100%)';
                        backdrop.style.display = 'none';
                    } else {
                        // Buka
                        sidebar.style.transform = 'translateX(0%)';
                        backdrop.style.display = 'block';
                    }
                }
            }

            function closeMobileSidebar() {
                let sidebar = document.getElementById('sidenav-main') || document.querySelector('aside');
                let backdrop = document.getElementById('mobile-backdrop');

                if (sidebar) {
                    sidebar.style.transform = 'translateX(-100%)';
                    backdrop.style.display = 'none';
                }
            }
        </script>

        <style>
            /* CSS INI CUMA JALAN DI LAYAR KECIL (HP/TABLET) */
            @media (max-width: 1024px) {

                /* 1. Munculin Tombol Hamburger */
                #mobile-menu-btn {
                    display: block !important;
                }

                /* 2. Atur Sidebar biar melayang & sembunyi dulu */
                aside, #sidenav-main {
                    position: fixed !important;
                    top: 0;
                    left: 0;
                    height: 100vh;
                    width: 260px !important;
                    max-width: 80% !important;
                    z-index: 9995 !important;
                    background-color: white !important;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);

                    /* Sembunyi ke kiri layar */
                    transform: translateX(-100%);
                    transition: transform 0.3s ease-in-out;

                    /* Biar scrollable kalau menunya panjang */
                    overflow-y: auto;
                }
            }
        </style>


    <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

        <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>

        {{-- Bagian ini akan memuat sidebar dan membuka tag <main> --}}
        @include('layout.partial.header')
            <div class="w-full px-6 py-6 mx-auto">

            {{-- [BARU] GLOBAL ALERT NOTIFICATION --}}
            {{-- Ini akan otomatis menangkap pesan ->with('success') atau ->with('error') dari Controller manapun --}}

            @if(session('success'))
                <div class="relative w-full p-4 mb-4 text-white bg-green-500 rounded-lg shadow-md flex justify-between items-center" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2 text-lg"></i>
                        <span class="text-sm font-bold">{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="text-white hover:text-gray-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="relative w-full p-4 mb-4 text-white bg-red-500 rounded-lg shadow-md flex justify-between items-center" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-lg"></i>
                        <span class="text-sm font-bold">{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="text-white hover:text-gray-100">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Validasi Error Form (Jika ada input yang salah) --}}
            @if ($errors->any())
                <div class="relative w-full p-4 mb-4 text-white bg-red-400 rounded-lg shadow-md" role="alert">
                    <ul class="list-disc list-inside text-sm font-bold">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- [AKHIR GLOBAL ALERT] --}}

            {{-- Di sinilah semua konten halaman akan ditampilkan --}}
            @yield('content')

            {{-- Footer sekarang menjadi bagian dari layout utama --}}
            <footer class="pt-4">
                <div class="w-full px-6 mx-auto">
                    <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                        <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2">
                            <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                                © <script> document.write(new Date().getFullYear()) </script>, Y.in Creative
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </main> {{-- Ini adalah tag penutup untuk <main> yang dibuka di header.blade.php --}}

    </body>

    {{-- File ini sekarang hanya berisi script --}}
    @include('layout.partial.script')
    @stack('scripts')
</html>

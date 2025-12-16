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

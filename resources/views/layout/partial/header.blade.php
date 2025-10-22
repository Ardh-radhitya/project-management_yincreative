    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-soft-in-out xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
            {{-- Arahkan logo ke dashboard yang sesuai --}}
            @php $dashboardRoute = route('login'); /* Default ke login */ @endphp
            @auth
                @if(strtolower(Auth::user()->role->name) == 'admin')
                    @php $dashboardRoute = route('dashboard.admin'); @endphp
                @elseif(strtolower(Auth::user()->role->name) == 'team')
                    @php $dashboardRoute = route('dashboard.team'); @endphp
                @elseif(strtolower(Auth::user()->role->name) == 'client')
                    @php $dashboardRoute = route('dashboard.client'); @endphp
                @endif
            @endauth
            <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700" href="{{ $dashboardRoute }}" target="_blank">
                <img src="{{ asset('argon-template/build/assets/img/logoyin.png') }}" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Y.in Creative</span>
            </a>
        </div>
        <hr class="h-px mt-0 bg-transparent bg-gradient-horizontal-dark" />
        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            @if(Auth::check())
                @if(strtolower(Auth::user()->role->name) == 'admin')
                    @include('layout.partial.sidebar.sbadmin')
                @elseif(strtolower(Auth::user()->role->name) == 'team')
                    @include('layout.partial.sidebar.sbteam')
                {{-- KONDISI BARU UNTUK CLIENT --}}
                @elseif(strtolower(Auth::user()->role->name) == 'client')
                    @include('layout.partial.sidebar.sbclient')
                @endif
            @endif
        </div>
    </aside>

    <main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
            {{-- ... Isi Navbar ... --}}
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                {{-- Breadcrumb bisa ditaruh di sini --}}
                <nav aria-label="breadcrumb">
                    {{-- <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">Dashboard</li>
                    </ol> --}}
                    <h6 class="mb-0 font-bold capitalize">
                        @yield('page-title', 'Dashboard') {{-- Judul halaman dinamis --}}
                    </h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    {{-- Kosongkan saja dulu bagian kanan navbar --}}
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full"> </ul>
                </div>
            </div>
        </nav>
        {{-- DIV PEMBUNGKUS KONTEN --}}
        <div class="w-full px-6 py-6 mx-auto">

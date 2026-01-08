{{-- ============================================= --}}
{{-- 1. SIDEBAR (MENU KIRI) --}}
{{-- ============================================= --}}
<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-soft-in-out xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">

    {{-- LOGO BRAND --}}
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
        @php $dashboardRoute = route('login'); @endphp
        @auth
            @if(strtolower(Auth::user()->role->name) == 'admin')
                @php $dashboardRoute = route('dashboard.admin'); @endphp
            @elseif(strtolower(Auth::user()->role->name) == 'team')
                @php $dashboardRoute = route('dashboard.team'); @endphp
            @elseif(strtolower(Auth::user()->role->name) == 'client')
                @php $dashboardRoute = route('dashboard.client'); @endphp
            @endif
        @endauth
        <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700" href="{{ $dashboardRoute }}">
            <img src="{{ asset('argon-template/build/assets/img/logoyin.png') }}" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Y.in Creative</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-horizontal-dark" />

    {{-- LIST MENU SIDEBAR --}}
    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">

            {{-- INCLUDE MENU UTAMA (Sesuai Role) --}}
            @if(Auth::check())
                @if(strtolower(Auth::user()->role->name) == 'admin')
                    @include('layout.partial.sidebar.sbadmin')
                @elseif(strtolower(Auth::user()->role->name) == 'team')
                    @include('layout.partial.sidebar.sbteam')
                @elseif(strtolower(Auth::user()->role->name) == 'client')
                    @include('layout.partial.sidebar.sbclient')
                @endif
            @endif

            {{-- ======================================== --}}
            {{-- BAGIAN AKUN (PROFILE & LOGOUT) - DISINI --}}
            {{-- ======================================== --}}

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase opacity-60">Akun Saya</h6>
            </li>

            {{-- Menu Profile --}}
            <li class="mt-0.5 w-full">
                <a class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::routeIs('profile.edit') ? 'bg-blue-500/13 rounded-lg font-semibold text-slate-700' : '' }}" href="{{ route('profile.edit') }}">
                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-slate-700 fas fa-user-circle"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profil</span>
                </a>
            </li>

            {{-- Menu Logout --}}
            <li class="mt-0.5 w-full">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors hover:bg-red-50 hover:text-red-600 rounded-lg cursor-pointer border-none bg-transparent">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-red-600 fas fa-sign-out-alt"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease text-red-600 font-semibold">Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</aside>


{{-- ============================================= --}}
{{-- 2. NAVBAR ATAS (Hanya Breadcrumb) --}}
{{-- ============================================= --}}
<main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb">
                <h6 class="mb-0 font-bold capitalize">
                    @yield('page-title', 'Dashboard')
                </h6>
            </nav>

            {{-- Bagian Kanan Navbar KOSONG (Karena menu sudah pindah ke kiri) --}}
            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                    {{-- Burger Menu (Wajib ada buat HP) --}}
                    <li class="flex items-center pl-4 xl:hidden">
                        <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500" sidenav-trigger>
                            <div class="w-4.5 overflow-hidden">
                                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                                <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    {{-- KONTEN --}}
    <div class="w-full px-6 py-6 mx-auto">

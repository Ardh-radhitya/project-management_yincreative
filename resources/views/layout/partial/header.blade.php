<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-soft-in-out xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700" href="{{ route('dashboard.admin') }}" target="_blank">
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
            @endif
        @endif
    </div>
</aside>

<main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            {{-- Breadcrumb bisa ditambahkan di sini jika perlu --}}
        </div>
    </nav>
    {{-- DIV PEMBUNGKUS KONTEN DITAMBAHKAN DI SINI --}}
    <div class="w-full px-6 py-6 mx-auto">

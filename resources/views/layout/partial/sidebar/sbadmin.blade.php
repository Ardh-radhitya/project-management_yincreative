<ul class="flex flex-col pl-0 mb-0">
    {{-- Dashboard --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('dashboard.admin') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('dashboard.admin') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
    </li>

    {{-- Project --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('projects.index') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('projects.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Project</span>
        </a>
    </li>

    {{-- Riwayat Proyek (SUDAH DISINKRONKAN) --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('projects.history') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('projects.history') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                {{-- Pakai warna Hijau/Emerald biar sinkron tapi ikon tetep Nucleo Style --}}
                <i class="relative top-0 text-size-sm leading-normal text-emerald-500 ni ni-archive-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">History</span>
        </a>
    </li>

    {{-- Categories --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('categories.*') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('categories.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-purple-500 ni ni-tag"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categories</span>
        </a>
    </li>

    {{-- Client --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('clients.*') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('clients.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-emerald-500 ni ni-circle-08"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Client</span>
        </a>
    </li>

    {{-- Users --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('users.*') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('users.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-cyan-500 ni ni-badge"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Users</span>
        </a>
    </li>
</ul>

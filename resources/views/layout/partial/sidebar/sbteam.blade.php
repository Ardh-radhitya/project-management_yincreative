<ul class="flex flex-col pl-0 mb-0">
    {{-- Dashboard Team --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('dashboard.team') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('dashboard.team') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
    </li>

    {{-- Project Team --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('projects.index') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('projects.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Project</span>
        </a>
    </li>

    {{-- Riwayat Proyek Team (SUDAH DISINKRONKAN) --}}
    <li class="mt-0.5 w-full">
        <a class="py-2.7 {{ request()->routeIs('projects.history') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('projects.history') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-emerald-500 ni ni-archive-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Riwayat Proyek</span>
        </a>
    </li>
</ul>

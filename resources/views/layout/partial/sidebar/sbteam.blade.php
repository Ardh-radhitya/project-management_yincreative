<ul class="flex flex-col pl-0 mb-0">
    <li class="mt-0.5 w-full">
        {{-- PERBAIKAN: Mengarah ke route 'dashboard.team' --}}
        <a class="py-2.7 {{ request()->routeIs('dashboard.team') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('dashboard.team') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
    </li>
    <li class="mt-0.5 w-full">
        {{-- PERBAIKAN: Menambahkan highlight menu aktif --}}
        <a class="py-2.7 {{ request()->routeIs('projects.*') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('projects.index') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Project</span>
        </a>
    </li>
</ul>

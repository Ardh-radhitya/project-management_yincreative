<ul class="flex flex-col pl-0 mb-0">
    <li class="mt-0.5 w-full">
        {{-- Link Dasbor Klien --}}
        <a class="py-2.7 {{ request()->routeIs('dashboard.client') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('dashboard.client') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
        </a>
    </li>
    <li class="mt-0.5 w-full">
        {{-- Link Ajukan Proyek Baru --}}
        <a class="py-2.7 {{ request()->routeIs('client.projects.create') ? 'bg-blue-500/13' : '' }} text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('client.projects.create') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-size-sm leading-normal text-emerald-500 ni ni-fat-add"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ajukan Proyek</span>
        </a>
    </li>
    {{-- Nanti bisa ditambahkan menu Proyek Saya, dll --}}
</ul>

@extends('layout.main')

@section('page-title', 'Dashboard Klien')

@section('content')
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Proyek</p>
                            <h5 class="mb-0 font-bold">{{ count($projects) }}</h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-500 to-violet-500">
                            <i class="ni ni-briefcase-24 text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent flex justify-between items-center">
                <h6 class="font-bold text-slate-700">Daftar Proyek Saya</h6>
                <a href="{{ route('client.projects.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-blue-500 to-violet-500">
                    <i class="fas fa-plus mr-1"></i> Ajukan Proyek Baru
                </a>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Proyek</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kategori</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal font-semibold text-slate-700">{{ $project->name }}</h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">ID: #{{ $project->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight text-slate-500">{{ $project->category->name ?? 'Umum' }}</p>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @php
                                        $badgeColor = match($project->status) {
                                            'Pending' => 'from-gray-600 to-slate-300',
                                            'In Progress' => 'from-blue-600 to-violet-600',
                                            'Completed' => 'from-green-600 to-lime-400',
                                            default => 'from-slate-600 to-slate-300',
                                        };
                                    @endphp
                                    <span class="bg-gradient-to-tl {{ $badgeColor }} px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ $project->status }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">
                                        {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($project->status === 'Pending')
                                        <a href="{{ route('client.projects.edit', $project->id) }}" class="text-xs font-semibold leading-tight text-slate-400 hover:text-blue-500 mx-2"> Edit </a>
                                    @else
                                        <a href="{{ route('client.projects.show', $project->id) }}" class="text-xs font-semibold leading-tight text-slate-400 hover:text-blue-500 mx-2"> Detail </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-sm text-slate-400">Belum ada proyek yang diajukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

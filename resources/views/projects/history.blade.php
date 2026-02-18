@extends('layout.main')

@section('page-title', 'Riwayat Proyek Selesai')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                {{-- HEADER & FILTER --}}
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="text-left">
                            <h6 class="font-bold mb-0">Riwayat Proyek (Selesai)</h6>
                            <p class="text-xs leading-tight text-slate-400">Daftar semua proyek yang telah mencapai status Completed.</p>
                        </div>

                        {{-- Quick Filter & Form --}}
                        <div class="flex flex-wrap items-center gap-4">
                            {{-- Quick Filter Pill --}}
                            <div class="flex gap-2 bg-gray-100 p-1 rounded-lg">
                                @foreach(['5d' => '5H', '1w' => '1Mgg', '1m' => '1Bln', '1y' => '1Thn'] as $key => $label)
                                    <a href="{{ route('projects.history', ['range' => $key]) }}"
                                        class="px-3 py-1 text-xs font-bold rounded-md transition-all {{ request('range') == $key ? 'bg-white shadow-soft-md text-blue-600' : 'text-slate-500 hover:text-blue-600' }}">
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>

                            {{-- Form Tanggal dengan Spasi yang Pas --}}
                        <form action="{{ route('projects.history') }}" method="GET" class="flex flex-wrap items-center gap-2">
                            <div class="flex items-center gap-1 bg-gray-50 p-1.5 rounded-lg border border-gray-100">
                                <input type="date" name="start_date" value="{{ request('start_date') }}" class="text-xs border-0 bg-transparent rounded-lg p-2 focus:ring-0">
                                <span class="text-slate-400 text-xs font-bold">-</span>
                                <input type="date" name="end_date" value="{{ request('end_date') }}" class="text-xs border-0 bg-transparent rounded-lg p-2 focus:ring-0">
                            </div>

                            {{-- Kasih margin kiri (ml-2) biar ada jarak dari input ke tombol --}}
                            <div class="flex items-center gap-2 ml-2">
                                {{-- Tombol Filter (Style Detail) --}}
                                <button type="submit" class="inline-block px-6 py-2 font-bold text-center text-white uppercase align-middle transition-all bg-slate-700 border-0 rounded-lg cursor-pointer shadow-soft-md text-xs tracking-tight hover:scale-105 active:opacity-85">
                                    Filter
                                </button>

                                {{-- Tombol Reset (Style Hapus) --}}
                                <a href="{{ route('projects.history') }}" class="inline-block px-6 py-2 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-red-600 to-orange-600 border-0 rounded-lg cursor-pointer shadow-soft-md text-xs tracking-tight hover:scale-105 active:opacity-85">
                                    Reset
                                </a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                {{-- TABEL DATA --}}
                <div class="flex-auto px-0 pt-0 pb-2 mt-4 text-left">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Proyek</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Klien</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Selesai Pada</th>
                                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $project)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent px-6 text-left">
                                        <h6 class="mb-0 text-sm font-semibold">{{ $project->name }}</h6>
                                        <p class="mb-0 text-xs text-slate-400">{{ $project->category->name ?? 'Umum' }}</p>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent px-6 text-left">
                                        <span class="text-xs font-semibold leading-tight text-slate-400">{{ $project->client->name ?? '-' }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400">{{ $project->updated_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                                        <a href="{{ route('projects.show', $project->id) }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro border-slate-700 text-xs ease-soft-in hover:scale-102 active:shadow-soft-xs tracking-tight-soft text-slate-700">Lihat Detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center italic text-sm">Tidak ada riwayat proyek dalam rentang waktu ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

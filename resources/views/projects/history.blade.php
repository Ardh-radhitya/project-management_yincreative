@extends('layout.main')

@section('page-title', 'Riwayat Proyek Selesai')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <div>
                    <h6 class="mb-0 font-bold text-slate-700">📜 Riwayat Proyek Selesai</h6>
                    <p class="text-xs leading-tight text-slate-400">Arsip semua proyek yang telah diselesaikan.</p>
                </div>
            </div>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Proyek</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Klien</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Selesai</th>
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                        <tr>
                            {{-- Kolom Nama --}}
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <a href="{{ route('projects.show', $project->id) }}" class="flex px-4 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal font-bold text-slate-700 hover:text-blue-500">{{ $project->name }}</h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">{{ $project->category->name ?? 'Multimedia' }}</p>
                                    </div>
                                </a>
                            </td>

                            {{-- Kolom Klien --}}
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 font-semibold leading-tight text-xs text-slate-700">{{ $project->client->name ?? 'N/A' }}</p>
                            </td>

                            {{-- Kolom Status --}}
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="px-3 py-2 text-xxs rounded-lg inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none bg-gradient-to-tl from-green-600 to-lime-400 text-white shadow-soft-md">
                                    {{ $project->status }}
                                </span>
                            </td>

                            {{-- Kolom Tanggal Selesai --}}
                            <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="font-semibold leading-tight text-xs text-slate-400">
                                    {{ \Carbon\Carbon::parse($project->updated_at)->format('d/m/Y') }}
                                </span>
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                                <a href="{{ route('projects.show', $project->id) }}"
                                    class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                                    style="background-color: #344767; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; margin-right: 4px;">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>

                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus arsip proyek ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                                            style="background-color: #f5365c; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: none;">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-slate-500 italic">Belum ada proyek yang selesai.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

@extends('layout.main')

@section('page-title', 'Manajemen Proyek')

@section('content')

@if (session('success'))
    <div class="alert-success" role="alert">
        <span class="font-bold">Sukses!</span> {{ session('success') }}
    </div>
@endif

<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="flex justify-between items-center">
            <h6 class="mb-0">Tabel Proyek</h6>

            {{-- PERBAIKAN DI SINI: Ganti semua class manual dengan "btn-primary" --}}
            <a href="{{ route('projects.create') }}" class="btn-primary">Tambah Proyek</a>

        </div>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Proyek</th>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Klien</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Selesai</th>
                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{ route('projects.show', $project->id) }}" class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 text-size-sm leading-normal hover:text-blue-500">{{ $project->name }}</h6>
                                    <p class="mb-0 text-size-xs leading-tight text-slate-400">{{ $project->category->name ?? '' }}</p>
                                </div>
                            </a>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $project->client->name ?? 'N/A' }}</p>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="px-3.6-em text-size-xs-em rounded-1.8 py-2.2-em inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none
                                bg-gradient-{{ $project->status == 'Completed' ? 'lime' : ($project->status == 'In Progress' ? 'cyan' : 'slate') }}
                                text-gray-800
                            ">{{ $project->status }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-size-xs text-slate-400">{{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}</span>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex items-center justify-center">
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn-action-edit mr-2"> Edit </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus proyek ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete"> Hapus </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-slate-500">Belum ada data proyek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    {{-- File ini berisi definisi .btn-primary, .btn-action-edit, dll. --}}
    @include('projects.style')
@endpush

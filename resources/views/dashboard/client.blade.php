@extends('layout.main')

@section('page-title', 'Dashboard Klien')

@section('content')
    @if (session('success'))
        <div class="alert-success mb-6" role="alert">
            <span class="font-bold">Sukses!</span> {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('client.projects.create') }}" class="btn-primary mb-6">Ajukan Proyek Baru</a>

    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6 class="mb-0">Proyek Anda</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Proyek</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Selesai</th>
                            {{-- KOLOM BARU UNTUK AKSI --}}
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    {{-- Nanti kita buat ini link ke detail proyek klien --}}
                                    <h6 class="mb-0 text-size-sm leading-normal">{{ $project->name }}</h6>
                                </div>
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
                            {{-- TOMBOL EDIT BARU --}}
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('client.projects.edit', $project->id) }}" class="btn-action-edit">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- Sesuaikan colspan menjadi 4 --}}
                            <td colspan="4" class="p-4 text-center text-slate-500">Anda belum memiliki proyek.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

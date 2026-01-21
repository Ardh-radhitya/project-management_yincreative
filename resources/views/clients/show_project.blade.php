@extends('layout.main')

@section('page-title', 'Detail Proyek')

@section('content')
<div class="w-full px-6 py-6 mx-auto">


    {{-- BAGIAN 1: INFO PROYEK --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6">
                    <div class="flex flex-wrap justify-between items-start">
                        <div class="w-full lg:w-3/4">
                            <h4 class="font-bold text-slate-700 mb-1">{{ $project->name }}</h4>
                            <p class="text-sm text-slate-500 mb-4">
                                Kategori: <span class="font-semibold text-blue-500">{{ $project->category->name ?? 'Umum' }}</span>
                            </p>

                            {{-- Kotak Deskripsi --}}
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                                <h6 class="text-xs font-bold uppercase text-slate-500 mb-2">Deskripsi Proyek</h6>
                                <p class="text-sm text-slate-700 leading-relaxed mb-0">
                                    {{ $project->description ?? 'Tidak ada deskripsi khusus.' }}
                                </p>
                            </div>

                            {{-- TOMBOL DOWNLOAD --}}
                            @if($project->file_path)
                                <div class="flex items-center mt-4">
                                    <div class="mr-3">
                                        <div class="inline-block p-3 text-center text-white bg-blue-500 rounded-lg shadow-sm">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-0 text-sm font-semibold">Dokumen Lampiran</h6>
                                        <p class="mb-0 text-xs text-slate-500">File referensi proyek</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank"
                                    class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-white border border-blue-500 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft hover:scale-102 hover:bg-blue-500 hover:text-white text-blue-500">
                                        <i class="fas fa-download mr-1"></i> Download
                                    </a>
                                </div>
                            @endif
                        </div>

                        {{-- Status Proyek Badge (FIXED: High Contrast Solid Color) --}}
                        <div class="w-full lg:w-1/4 text-right mt-4 lg:mt-0">
                            <span class="px-4 py-2 rounded-lg text-white font-bold text-xs uppercase shadow-md inline-block
                                @if($project->status == 'Pending') bg-gray-500
                                @elseif($project->status == 'In Progress') bg-blue-500
                                @elseif($project->status == 'Completed') bg-green-500
                                @else bg-slate-500 @endif">
                                {{ $project->status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN 2: STATUS TUGAS (VIEW ONLY) --}}
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="font-bold text-slate-700">Timeline Pengerjaan (Tugas)</h6>
                    <p class="text-xs text-slate-500">Daftar tugas yang dikerjakan oleh tim internal.</p>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tugas</th>
                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dikerjakan Oleh</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal font-semibold text-slate-700">{{ $task->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex items-center">
                                            @if($task->user)
                                                <span class="text-xs font-semibold leading-tight text-slate-500"> {{ $task->user->name }} </span>
                                            @else
                                                <span class="text-xs font-semibold leading-tight text-slate-400 italic">Tim Internal</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        {{-- Badge Status Tugas (FIXED: High Contrast) --}}
                                        <span class="text-xs font-bold uppercase py-1 px-3 rounded-lg text-white shadow-sm
                                            @if($task->status == 'Done' || $task->status == 'Selesai') bg-green-500
                                            @elseif($task->status == 'In Progress') bg-blue-500
                                            @else bg-gray-400 @endif">
                                            {{ $task->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="p-8 text-center text-slate-400 bg-gray-50 rounded-lg italic">
                                        Belum ada rincian tugas yang ditampilkan.
                                    </td>
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

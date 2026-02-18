@extends('layout.main')

@section('page-title', 'Detail Proyek & Tugas')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    {{-- BAGIAN 1: INFO PROYEK --}}
    <div class="flex flex-wrap -mx-3 mb-6 text-left">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border p-6">

                {{-- ROW 1: HEADER & STATUS --}}
                <div class="flex flex-wrap justify-between items-center mb-4 gap-4">
                    <div class="flex-1 min-w-[300px]">
                        <h4 class="font-bold text-slate-700 mb-1">{{ $project->name }}</h4>
                        <p class="text-sm text-slate-500 mb-0">
                            <i class="fas fa-tag mr-1 opacity-50"></i> {{ $project->category->name ?? 'Umum' }} &nbsp;•&nbsp;
                            <i class="fas fa-user mr-1 opacity-50"></i> {{ $project->client->name ?? '-' }}
                        </p>
                    </div>
                    {{-- GRUP TOMBOL DENGAN GAP YANG PAS --}}
                    <div class="flex items-center">
                        @php
                            $badgeStyle = match($project->status) {
                                'Pending'     => 'background: linear-gradient(310deg, #a0aec0 0%, #a8b8d8 100%); color: #fff;',
                                'In Progress' => 'background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); color: #fff;',
                                'Completed'   => 'background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%); color: #fff;',
                                default       => 'background: #cbd5e0; color: #fff;',
                            };
                        @endphp

                        {{-- Badge Status --}}
                        <span style="{{ $badgeStyle }}" class="px-4 py-2 rounded-lg font-bold text-xs uppercase shadow-md inline-block tracking-wide">
                            {{ $project->status }}
                        </span>

                        @if($project->status != 'Completed')
                            {{-- Kita bungkus tombolnya pake div dengan margin-left (ml-4) biar bener-bener kepisah --}}
                            <div class="ml-4">
                                <a href="{{ route('projects.tasks.create', $project->id) }}"
                                class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-blue-500 to-violet-500 border-0 rounded-lg cursor-pointer shadow-md hover:scale-105 active:opacity-85 text-xs">
                                    <i class="fas fa-plus mr-1"></i> Tambah Tugas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="horizontal dark my-4">

                {{-- ROW 2: DESKRIPSI (FULL WIDTH) --}}
                <div class="mb-6 text-left">
                    <h6 class="text-xs font-bold uppercase text-slate-400 mb-2">Deskripsi Proyek</h6>
                    <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                        {{ $project->description ?? 'Tidak ada deskripsi khusus.' }}
                    </p>
                </div>

                {{-- ROW 3: FILE & ASSETS (HORIZONTAL GRID) --}}
                <div class="flex flex-wrap -mx-3 gap-y-4">
                    {{-- Box Hasil Akhir --}}
                    <div class="w-full md:w-1/2 px-3 text-left">
                        <div class="p-4 border border-solid border-purple-100 rounded-2xl bg-purple-50 flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <div>
                                    <h6 class="mb-0 text-sm font-bold text-slate-700">Hasil Proyek</h6>
                                    <p class="mb-0 text-xxs text-slate-500 uppercase font-bold tracking-wider">Final Deliverables</p>
                                </div>
                            </div>
                            <a href="{{ route('projects.delivery.index', $project->id) }}" class="px-5 py-2 bg-white text-purple-700 border border-purple-200 rounded-lg text-xs font-bold uppercase hover:bg-purple-700 hover:text-white transition-all shadow-soft-sm">
                                Buka
                            </a>
                        </div>
                    </div>

                    {{-- Box Lampiran Referensi --}}
                    <div class="w-full md:w-1/2 px-3 text-left">
                        <div class="p-4 border border-solid border-blue-100 rounded-2xl bg-blue-50 flex items-center justify-between shadow-sm">
                            <div class="flex items-center">
                                <div>
                                    <h6 class="mb-0 text-sm font-bold text-slate-700">Lampiran Klien</h6>
                                    <p class="mb-0 text-xxs text-slate-500 uppercase font-bold tracking-wider">Project Reference</p>
                                </div>
                            </div>
                            @if($project->file_path)
                                <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="px-5 py-2 bg-white text-blue-600 border border-blue-200 rounded-lg text-xs font-bold uppercase hover:bg-blue-600 hover:text-white transition-all shadow-soft-sm">
                                    Unduh
                                </a>
                            @else
                                <span class="text-xs italic text-slate-400 font-semibold pr-4">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- BAGIAN 2: DAFTAR TUGAS --}}
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="font-bold text-slate-700 flex items-center gap-2">
                        Daftar Tugas & Progress
                    </h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2 mt-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Judul Tugas</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ditugaskan Ke</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diskusi</th>
                                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal font-semibold text-slate-700 hover:text-blue-500">{{ $task->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex items-center gap-2">
                                            @if($task->user)
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($task->user->name) }}&background=random&color=fff&size=24" class="w-6 h-6 rounded-full shadow-sm">
                                                <span class="text-xs font-semibold leading-tight text-slate-600"> {{ $task->user->name }} </span>
                                            @else
                                                <span class="px-2 py-1 rounded bg-slate-100 text-xs font-semibold text-slate-400 italic border border-slate-200">Unassigned</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        {{-- Dropdown Status dikunci jika Proyek Selesai --}}
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" @if($project->status == 'Completed') disabled @endif class="text-xs font-bold uppercase py-1 px-3 rounded-lg border-0 shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" style="@if($task->status == 'Done') background-color: #dcfce7; color: #166534; @elseif($task->status == 'In Progress') background-color: #dbeafe; color: #1e40af; @else background-color: #f1f5f9; color: #475569; @endif">
                                                <option class="bg-white text-slate-600" value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                                <option class="bg-white text-slate-600" value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option class="bg-white text-slate-600" value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <button type="button" onclick="openTaskModal('task-modal-{{ $task->id }}')" class="inline-block px-3 py-1 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-blue-400 border-solid rounded-lg cursor-pointer leading-pro text-xxs hover:scale-102 active:opacity-85 hover:shadow-sm text-blue-500 hover:bg-blue-500 hover:text-white">
                                            <i class="fas fa-comments mr-1"></i> {{ $task->progress->count() }}
                                        </button>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- AKSI DIKUNCI JIKA PROYEK SELESAI --}}
                                            @if($project->status != 'Completed')
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="inline-block px-3 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs"
                                                style="background-color: #344767;">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block m-0" onsubmit="return confirm('Hapus tugas ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="inline-block px-3 py-2 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs"
                                                        style="background-color: #f5365c; border: none;">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                            @else
                                            <span class="text-xxs font-bold text-slate-400 italic">No Action Available</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400">
                                        <div class="flex flex-col items-center"><i class="fas fa-clipboard-list text-3xl mb-2 opacity-50"></i><p class="text-sm">Belum ada tugas.</p></div>
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

{{-- MODAL AREA --}}
@foreach($tasks as $task)
    <div id="task-modal-{{ $task->id }}" class="modal-diskusi hidden">
        <div class="modal-backdrop" onclick="closeTaskModal('task-modal-{{ $task->id }}')"></div>
        <div class="modal-content">
            <div class="p-4 border-b bg-slate-50 flex justify-between items-center">
                <div>
                    <h5 class="font-bold text-slate-800 text-lg mb-0">{{ $task->title }}</h5>
                    <div class="flex items-center gap-2 mt-1 text-xs text-slate-500">
                        <span class="px-2 py-0.5 rounded bg-slate-200 font-bold text-slate-700">{{ $task->status }}</span>
                    </div>
                </div>
                <button type="button" onclick="closeTaskModal('task-modal-{{ $task->id }}')" class="text-slate-400 hover:text-red-500 text-3xl leading-none px-2">&times;</button>
            </div>
            <div class="p-6 bg-slate-100 overflow-y-auto flex-1 space-y-4" style="max-height: 60vh;">
                @if($task->description)
                    <div class="p-4 bg-white rounded-xl shadow-sm border border-slate-200 mb-6">
                        <h6 class="text-xs font-bold uppercase text-slate-400 mb-2">Deskripsi Tugas</h6>
                        <p class="text-sm text-slate-700">{{ $task->description }}</p>
                    </div>
                @endif
                <h6 class="text-xs font-bold uppercase text-slate-400 mb-2 flex items-center gap-2">
                    <i class="fas fa-history"></i> Riwayat & Diskusi
                </h6>
                @forelse($task->progress as $prog)
                    <div class="flex gap-3">
                        <div class="flex-shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($prog->user->name) }}&background=random&color=fff&size=32" class="w-8 h-8 rounded-full shadow-sm">
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-baseline mb-1">
                                <span class="text-sm font-bold text-slate-700">{{ $prog->user->name ?? 'Unknown' }}</span>
                                <span class="text-xs text-slate-400">{{ $prog->created_at->format('d M H:i') }}</span>
                            </div>
                            <div class="bg-white p-3 rounded-lg rounded-tl-none border border-slate-200 shadow-sm text-sm text-slate-600">
                                {{ $prog->progress_note }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-slate-400 text-sm">Belum ada aktivitas diskusi.</div>
                @endforelse
            </div>
            <div class="p-4 bg-white border-t z-10">
                {{-- DISKUSI DIKUNCI JIKA SELESAI --}}
                @if($project->status != 'Completed')
                <form action="{{ route('tasks.progress.store', $task->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="progress_note" class="flex-1 p-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Ketik pesan..." required autocomplete="off">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                @else
                <p class="text-center text-xs text-slate-400 italic py-2">Proyek telah selesai. Diskusi dinonaktifkan.</p>
                @endif
            </div>
        </div>
    </div>
@endforeach

<script>
    function openTaskModal(modalID) {
        let modal = document.getElementById(modalID);
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
        modal.classList.remove('hidden');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100vw';
        modal.style.height = '100vh';
        modal.style.zIndex = '9999999';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';

        let backdrop = modal.querySelector('.modal-backdrop');
        if(backdrop) {
            backdrop.style.position = 'absolute';
            backdrop.style.top = '0';
            backdrop.style.left = '0';
            backdrop.style.width = '100%';
            backdrop.style.height = '100%';
            backdrop.style.backgroundColor = 'rgba(0,0,0,0.5)';
            backdrop.style.backdropFilter = 'blur(4px)';
            backdrop.style.zIndex = '-1';
        }

        let content = modal.querySelector('.modal-content');
        if(content) {
            content.style.position = 'relative';
            content.style.zIndex = '10';
            content.style.width = '100%';
            content.style.maxWidth = '600px';
            content.style.backgroundColor = 'white';
            content.style.borderRadius = '16px';
            content.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.25)';
            content.style.display = 'flex';
            content.style.flexDirection = 'column';
            content.style.overflow = 'hidden';
            content.style.margin = '20px';
        }
    }

    function closeTaskModal(modalID) {
        let modal = document.getElementById(modalID);
        if (modal) {
            modal.style.display = 'none';
        }
    }
</script>

@endsection

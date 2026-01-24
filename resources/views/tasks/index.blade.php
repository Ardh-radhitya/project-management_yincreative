@extends('layout.main')

@section('page-title', 'Detail Proyek & Tugas')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    {{-- BAGIAN 1: INFO PROYEK --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6">
                    <div class="flex flex-wrap justify-between items-start">
                        <div class="w-full lg:w-3/4">
                            <h4 class="font-bold text-slate-700 mb-1 flex items-center gap-2">
                                {{ $project->name }}
                            </h4>
                            <p class="text-sm text-slate-500 mb-4 ml-0">
                                Kategori: <span class="font-semibold text-slate-700">{{ $project->category->name ?? 'Umum' }}</span> &nbsp;•&nbsp;
                                Klien: <span class="font-semibold text-slate-700">{{ $project->client->name ?? '-' }}</span>
                            </p>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 mb-4">
                                <h6 class="text-xs font-bold uppercase text-slate-400 mb-2">Deskripsi Proyek</h6>
                                <p class="text-sm text-slate-600 leading-relaxed mb-0">
                                    {{ $project->description ?? 'Tidak ada deskripsi khusus.' }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/4 text-right flex flex-col items-end">
                            @php
                                $badgeStyle = match($project->status) {
                                    'Pending'     => 'background: linear-gradient(310deg, #a0aec0 0%, #a8b8d8 100%); color: #fff;',
                                    'In Progress' => 'background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); color: #fff;',
                                    'Completed'   => 'background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%); color: #fff;',
                                    default       => 'background: #cbd5e0; color: #fff;',
                                };
                            @endphp
                            <span style="{{ $badgeStyle }}" class="px-4 py-2 rounded-lg font-bold text-xs uppercase shadow-md mb-4 inline-block tracking-wide">
                                {{ $project->status }}
                            </span>
                            <a href="{{ route('projects.tasks.create', $project->id) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-blue-500 to-violet-500 border-0 rounded-lg cursor-pointer shadow-md hover:scale-105 hover:shadow-lg active:opacity-85">
                                <i class="fas fa-plus mr-1"></i> Tambah Tugas
                            </a>
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
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold uppercase py-1 px-3 rounded-lg border-0 shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" style="@if($task->status == 'Done') background-color: #dcfce7; color: #166534; @elseif($task->status == 'In Progress') background-color: #dbeafe; color: #1e40af; @else background-color: #f1f5f9; color: #475569; @endif">
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
                                        {{-- Edit Project --}}
                                        <a href="{{ route('tasks.edit', $project->id) }}"
                                        class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                                        style="background-color: #344767; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; margin-right: 4px;">
                                            Edit
                                        </a>

                                        {{-- Delete Project --}}
                                        <form action="{{ route('tasks.destroy', $project->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus tugas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                                                    style="background-color: #f5365c; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: none;">
                                                Hapus
                                            </button>
                                        </form>
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
    {{-- Kita kasih ID unik dan class 'modal-diskusi' buat penanda --}}
    <div id="task-modal-{{ $task->id }}" class="modal-diskusi hidden">
        {{-- Overlay Hitam (Backdrop) --}}
        <div class="modal-backdrop" onclick="closeTaskModal('task-modal-{{ $task->id }}')"></div>

        {{-- Konten Modal --}}
        <div class="modal-content">
            {{-- Header --}}
            <div class="p-4 border-b bg-slate-50 flex justify-between items-center">
                <div>
                    <h5 class="font-bold text-slate-800 text-lg mb-0">{{ $task->title }}</h5>
                    <div class="flex items-center gap-2 mt-1 text-xs text-slate-500">
                        <span class="px-2 py-0.5 rounded bg-slate-200 font-bold text-slate-700">{{ $task->status }}</span>
                    </div>
                </div>
                <button type="button" onclick="closeTaskModal('task-modal-{{ $task->id }}')" class="text-slate-400 hover:text-red-500 text-3xl leading-none px-2">&times;</button>
            </div>

            {{-- Body --}}
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

            {{-- Footer --}}
            <div class="p-4 bg-white border-t z-10">
                <form action="{{ route('tasks.progress.store', $task->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="progress_note" class="flex-1 p-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Ketik pesan..." required autocomplete="off">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- SCRIPT JURUS PAKSA (HARDCORE STYLE) --}}
<script>
    function openTaskModal(modalID) {
        let modal = document.getElementById(modalID);

        // 1. PINDAHIN KE BODY (WAJIB)
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }

        // 2. RESET CLASS BIAR GAK CRASH SAMA TAILWIND
        modal.classList.remove('hidden');

        // 3. PAKSA CSS LANGSUNG DI ELEMENT (OVERRIDE SEGALA MACEM STYLE BAWAAN)
        // Container Utama
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100vw';
        modal.style.height = '100vh';
        modal.style.zIndex = '9999999'; // Z-Index Jebol Langit
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';

        // Backdrop
        let backdrop = modal.querySelector('.modal-backdrop');
        if(backdrop) {
            backdrop.style.position = 'absolute';
            backdrop.style.top = '0';
            backdrop.style.left = '0';
            backdrop.style.width = '100%';
            backdrop.style.height = '100%';
            backdrop.style.backgroundColor = 'rgba(0,0,0,0.5)';
            backdrop.style.backdropFilter = 'blur(4px)';
            backdrop.style.zIndex = '-1'; // Di belakang konten
        }

        // Konten (Kotak Putih)
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
            modal.style.display = 'none'; // Sembunyiin lagi
        }
    }
</script>

@endsection

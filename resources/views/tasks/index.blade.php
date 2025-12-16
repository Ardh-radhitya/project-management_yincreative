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
                            <h4 class="font-bold text-slate-700 mb-1">{{ $project->name }}</h4>
                            <p class="text-sm text-slate-500 mb-4">
                                Kategori: <span class="font-semibold">{{ $project->category->name ?? 'Umum' }}</span> &nbsp;•&nbsp;
                                Klien: <span class="font-semibold">{{ $project->client->name ?? '-' }}</span>
                            </p>
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 mb-4">
                                <h6 class="text-xs font-bold uppercase text-slate-500 mb-2">Deskripsi Proyek</h6>
                                <p class="text-sm text-slate-700 leading-relaxed mb-0">
                                    {{ $project->description ?? 'Tidak ada deskripsi khusus.' }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/4 text-right">
                            {{-- Status Proyek Badge --}}
                            @php
                                $badgeColor = match($project->status) {
                                    'Pending' => 'from-gray-600 to-slate-300',
                                    'In Progress' => 'from-blue-600 to-violet-600',
                                    'Completed' => 'from-green-600 to-lime-400',
                                    default => 'from-slate-600 to-slate-300',
                                };
                            @endphp
                            <span class="bg-gradient-to-tl {{ $badgeColor }} px-4 py-2 rounded-lg text-white font-bold text-xs uppercase shadow-md mb-4 inline-block">
                                {{ $project->status }}
                            </span>
                            <br>
                            <a href="{{ route('projects.tasks.create', $project->id) }}" class="inline-block px-6 py-3 font-bold text-center text-slate-800 uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-blue-600 to-cyan-400">
                                <i class="fas fa-plus mr-1"></i> Tambah Tugas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg shadow-md">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- BAGIAN 2: DAFTAR TUGAS --}}
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="font-bold text-slate-700">Daftar Tugas & Progress</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tugas</th>
                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ditugaskan Kepada</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diskusi / Progress</th>
                                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
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
                                                <i class="fas fa-user-circle text-slate-400 mr-2 text-lg"></i>
                                                <span class="text-xs font-semibold leading-tight text-slate-500"> {{ $task->user->name }} </span>
                                            @else
                                                <span class="text-xs font-semibold leading-tight text-slate-400 italic">Belum ditugaskan</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            {{-- Dropdown Status dengan Inline Style untuk Warna --}}
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs font-bold uppercase py-1 px-3 rounded-lg border-2 cursor-pointer focus:outline-none"
                                                style="@if($task->status == 'Done') color: #16a34a; border-color: #16a34a; background-color: #f0fdf4; @elseif($task->status == 'In Progress') color: #2563eb; border-color: #2563eb; background-color: #eff6ff; @else color: #475569; border-color: #475569; background-color: #f8fafc; @endif">
                                                <option class="text-black bg-white" value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                                <option class="text-black bg-white" value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option class="text-black bg-white" value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        {{-- TOMBOL BUKA MODAL --}}
                                        <button type="button" onclick="document.getElementById('task-modal-{{ $task->id }}').classList.remove('hidden')"
                                            class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-blue-500 hover:bg-blue-500 hover:text-white">
                                            <i class="fas fa-comments mr-1"></i> {{ $task->progress->count() }} Komentar
                                        </button>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-slate-400 hover:text-blue-500 mx-2 font-bold text-xs">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus tugas ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-500 font-bold text-xs border-none bg-transparent cursor-pointer">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400">Belum ada tugas. Silakan buat tugas baru.</td>
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

{{-- BAGIAN 3: MODAL POPUP (VERSI AMAN DENGAN INLINE STYLES) --}}
@push('modals')
    @foreach($tasks as $task)
        {{-- Overlay Hitam --}}
        <div id="task-modal-{{ $task->id }}" class="hidden fixed top-0 left-0 w-full h-full" style="z-index: 9999; background-color: rgba(0,0,0,0.6); display: none;">

            {{-- Container Modal (Tengah Layar) --}}
            <div class="flex items-center justify-center w-full h-full p-4">

                {{-- Kotak Modal Putih --}}
                <div class="bg-white rounded-2xl shadow-2xl flex flex-col relative w-full md:w-3/4 lg:w-2/3" style="max-height: 85vh; display: flex; flex-direction: column;">

                    {{-- Header Modal --}}
                    <div class="p-5 border-b bg-gray-50 rounded-t-2xl flex justify-between items-center shrink-0">
                        <div>
                            <h5 class="font-bold text-slate-800 text-lg mb-0">{{ $task->title }}</h5>
                            <p class="text-xs text-slate-500 mb-0 mt-1">Status: <b>{{ $task->status }}</b> • Assigned: <b>{{ $task->user->name ?? '-' }}</b></p>
                        </div>
                        <button type="button" onclick="document.getElementById('task-modal-{{ $task->id }}').style.display = 'none'" class="text-slate-400 hover:text-red-500 font-bold text-xl px-2">
                            &times;
                        </button>
                    </div>

                    {{-- Body Modal (Chat Scrollable) --}}
                    <div class="p-6 bg-slate-50 overflow-y-auto" style="flex: 1;">
                        @if($task->description)
                            <div class="mb-6 p-4 bg-white rounded-xl shadow-sm border border-slate-200">
                                <h6 class="text-xs font-bold uppercase text-slate-400 mb-2">Deskripsi</h6>
                                <p class="text-sm text-slate-700 leading-relaxed">{{ $task->description }}</p>
                            </div>
                        @endif

                        <h6 class="text-xs font-bold uppercase text-slate-400 mb-4 flex items-center">
                            <i class="fas fa-history mr-2"></i> Diskusi
                        </h6>

                        <div class="space-y-4">
                            @forelse($task->progress as $prog)
                                <div class="flex gap-4" style="display: flex; gap: 1rem;">
                                    {{-- Avatar --}}
                                    <div class="flex-shrink-0" style="flex-shrink: 0;">
                                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                            {{ substr($prog->user->name ?? '?', 0, 2) }}
                                        </div>
                                    </div>
                                    {{-- Bubble --}}
                                    <div style="flex: 1;">
                                        <div class="flex justify-between items-baseline mb-1">
                                            <span class="text-sm font-bold text-slate-800">{{ $prog->user->name ?? 'User Hapus' }}</span>
                                            <span class="text-xs text-slate-400">{{ $prog->created_at->format('d M H:i') }}</span>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg border border-slate-200 shadow-sm text-sm text-slate-600">
                                            {{ $prog->progress_note }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 text-slate-400 text-sm">
                                    Belum ada laporan progress.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Footer Modal (Form Input) --}}
                    <div class="p-4 border-t bg-white rounded-b-2xl shrink-0">
                        <form action="{{ route('tasks.progress.store', $task->id) }}" method="POST" style="display: flex; gap: 10px;">
                            @csrf
                            <textarea name="progress_note" rows="1" class="w-full p-3 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Tulis update..." required style="flex: 1; resize: none;"></textarea>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 uppercase text-xs flex items-center">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    {{-- Script Kecil untuk Handle Buka/Tutup Modal dengan CSS Display --}}
    <script>
        function toggleModal(id) {
            var modal = document.getElementById(id);
            if (modal.style.display === "none" || modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.style.display = "flex"; // Pakai Flex biar centering jalan
            } else {
                modal.style.display = "none";
            }
        }

        // Update tombol di tabel agar memanggil fungsi ini
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll("[onclick^='document.getElementById(\"task-modal-']");
            buttons.forEach(btn => {
                const onclickVal = btn.getAttribute('onclick');
                const modalId = onclickVal.match(/'(.*?)'/)[1];
                btn.setAttribute('onclick', `toggleModal('${modalId}')`);
            });
        });
    </script>
@endpush

@endsection

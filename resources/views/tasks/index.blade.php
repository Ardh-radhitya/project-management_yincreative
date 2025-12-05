@extends('layout.main')

@section('page-title', 'Daftar Tugas')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    {{-- Header Proyek --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <div>
                            <h6 class="mb-1 font-bold text-slate-700">Proyek: {{ $project->name }}</h6>
                            <p class="text-sm text-slate-500 mb-0">Kelola semua tugas untuk proyek ini di sini.</p>
                        </div>
                        <div>
                            <a href="{{ route('projects.tasks.create', $project->id) }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-blue-600 to-cyan-400">
                                <i class="fas fa-plus mr-1"></i> Tambah Tugas
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div class="mx-6 mt-4 p-4 text-sm text-white bg-gradient-to-tl from-green-600 to-lime-400 rounded-lg shadow-md">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tugas</th>
                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ditugaskan Kepada</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi Cepat</th>
                                    <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $task)
                                <tr>
                                    {{-- Kolom Judul --}}
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal font-semibold text-slate-700">{{ $task->title }}</h6>
                                                <p class="mb-0 text-xs leading-tight text-slate-400 truncate max-w-xs">{{ Str::limit($task->description, 50) }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Assigned To --}}
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex items-center">
                                            @if($task->user)
                                            <i class="fas fa-user-circle text-slate-400 mr-2"></i>
                                                <span class="text-xs font-semibold leading-tight text-slate-500"> {{ $task->user->name }} </span>
                                            @else
                                                <span class="text-xs font-semibold leading-tight text-slate-400 italic">Belum ditugaskan</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kolom Status (Dropdown Update) --}}
                                    <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-xs font-bold uppercase py-1 px-3 rounded-lg border-2 cursor-pointer focus:outline-none
                                                @if($task->status == 'Done')
                                                    text-green-600 border-green-600 bg-green-50
                                                @elseif($task->status == 'In Progress')
                                                    text-blue-600 border-blue-600 bg-blue-50
                                                @else
                                                    text-slate-600 border-slate-600 bg-slate-50
                                                @endif">
                                                <option class="text-slate-700 bg-white" value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                                <option class="text-slate-700 bg-white" value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option class="text-slate-700 bg-white" value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                            </select>
                                        </form>
                                    </td>

                                    {{-- Kolom Aksi Cepat (Lapor Progress) --}}
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <button type="button" onclick="document.getElementById('progress-modal-{{ $task->id }}').classList.remove('hidden')"
                                            class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-blue-500 hover:bg-blue-500 hover:text-white">
                                            <i class="fas fa-comment-alt mr-1"></i> Lapor
                                        </button>

                                        {{-- Modal Lapor Progress (Sederhana) --}}
                                        <div id="progress-modal-{{ $task->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                            <div class="bg-white rounded-lg shadow-lg w-1/3 p-6">
                                                <h5 class="mb-4 font-bold text-slate-700">Lapor Progress: {{ $task->title }}</h5>
                                                <form action="{{ route('tasks.progress.store', $task->id) }}" method="POST">
                                                    @csrf
                                                    <textarea name="progress_note" rows="3" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Apa yang sudah dikerjakan?" required></textarea>
                                                    <div class="flex justify-end mt-4">
                                                        <button type="button" onclick="document.getElementById('progress-modal-{{ $task->id }}').classList.add('hidden')" class="mr-2 px-4 py-2 text-xs font-bold text-slate-500 bg-gray-200 rounded-lg">Batal</button>
                                                        <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-blue-500 rounded-lg">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Edit/Hapus --}}
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-slate-400 hover:text-blue-500 mx-2 font-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-400 hover:text-red-500 font-bold text-xs border-none bg-transparent cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-slate-500 italic">Belum ada tugas di proyek ini.</td>
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

    @extends('layout.main')

    @section('page-title', 'Edit Tugas')

    @section('content')
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3">

                {{-- CARD PEMBUNGKUS UTAMA --}}
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">

                    {{-- Header Card --}}
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">
                            <i class="fas fa-edit mr-2 text-slate-500"></i>Edit Tugas
                        </h6>
                        <p class="text-sm text-slate-500 mt-1">
                            Mengubah detail tugas untuk proyek:
                            {{-- Ambil nama project dari relasi task --}}
                            <span class="font-bold text-slate-700">{{ $task->project->name ?? 'Unknown Project' }}</span>
                        </p>
                    </div>

                    {{-- Body Form --}}
                    <div class="flex-auto p-6">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- INPUT JUDUL TUGAS --}}
                            <div class="mb-6">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700 uppercase">Judul Tugas</label>
                                <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                    placeholder="Contoh: Buat Wireframe Homepage">
                            </div>

                            {{-- GRID 2 KOLOM (Status & Assignee) --}}
                            <div class="flex flex-wrap -mx-3 mb-6">

                                {{-- KOLOM KIRI: STATUS --}}
                                <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                                    <label class="mb-2 ml-1 font-bold text-xs text-slate-700 uppercase">Status</label>
                                    <div class="relative">
                                        <select name="status" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                            <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do (Baru)</option>
                                            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress (Sedang Dikerjakan)</option>
                                            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done (Selesai)</option>
                                        </select>
                                        {{-- Icon Panah Dropdown --}}
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                            <i class="fas fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- INPUT DESKRIPSI (TEXTAREA) --}}
                            <div class="mb-6">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700 uppercase">Deskripsi Detail</label>
                                <textarea name="description" rows="5"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none"
                                    placeholder="Jelaskan detail tugas apa yang harus dikerjakan...">{{ old('description', $task->description) }}</textarea>
                            </div>

                            {{-- TOMBOL ACTION (YANG UDAH KITA BENERIN TADI) --}}
                            <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                {{-- Tombol Batal: Pake $task->project_id (AMAN) --}}
                                <a href="{{ route('projects.show', $task->project_id) }}"
                                class="inline-block px-6 py-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs hover:bg-gray-300">
                                    Batal
                                </a>

                                {{-- Tombol Simpan --}}
                                <button type="submit"
                                        class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs active:opacity-85"
                                        style="background-color: #5e72e4; border: none;">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @extends('layout.main')

    @section('page-title', 'Tambah Tugas Baru')

    @section('content')
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

        {{-- HEADER CARD --}}
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6 class="font-bold text-slate-700">Tambah Tugas Baru untuk Proyek: <span class="text-purple-600">{{ $project->name }}</span></h6>
        </div>

        <div class="flex-auto p-6">
            {{-- FORM START --}}
            <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
                @csrf

                {{-- 1. INPUT JUDUL (Full Width & Modern) --}}
                <div class="mb-6">
                    <label for="title" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                        Judul Tugas
                    </label>
                    <input type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Desain Database, Fix Bug Login..."
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-purple-500 focus:outline-none @error('title') border-red-500 @enderror"
                        required />
                    @error('title')
                        <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. INPUT DESKRIPSI --}}
                <div class="mb-6">
                    <label for="description" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                        Deskripsi (Opsional)
                    </label>
                    <textarea name="description"
                            id="description"
                            rows="4"
                            placeholder="Jelaskan detail tugas ini..."
                            class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-purple-500 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p>
                    @enderror
                </div>

                {{-- 3. GRID SYSTEM (Status & Assigned To) --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">

                    {{-- Dropdown Status --}}
                    <div>
                        <label for="status" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Status Awal
                        </label>
                        <div class="relative">
                            <select name="status"
                                    id="status"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none cursor-pointer @error('status') border-red-500 @enderror">
                                <option value="To Do" {{ old('status', 'To Do') == 'To Do' ? 'selected' : '' }}>To Do</option>
                                <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                            {{-- Panah Custom --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('status')
                            <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Dropdown Assigned To --}}
                    <div>
                        <label for="assigned_to_user_id" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Tugaskan Kepada (Opsional)
                        </label>
                        <div class="relative">
                            <select name="assigned_to_user_id"
                                    id="assigned_to_user_id"
                                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none cursor-pointer @error('assigned_to_user_id') border-red-500 @enderror">
                                <option value="">-- Belum Ditugaskan --</option>
                                @foreach ($teamMembers as $member)
                                    <option value="{{ $member->id }}" {{ old('assigned_to_user_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Panah Custom --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('assigned_to_user_id')
                            <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- 4. TOMBOL ACTION --}}
                <div class="flex items-center justify-end gap-3 mt-8">

                    {{-- Tombol Batal (Abu Terang - Konsisten) --}}
                    {{-- Pastikan route-nya bener, misal: projects.show atau tasks.index --}}
                    <a href="{{ route('projects.show', $project->id) }}"
                    class="inline-block px-6 py-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs hover:bg-gray-300">
                        Batal
                    </a>

                    {{-- Tombol Simpan (Biru Solid - Konsisten) --}}
                    <button type="submit"
                            class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs"
                            style="background-color: #5e72e4; border: none;">
                        Simpan Tugas
                    </button>

                </div>
            </form>
        </div>
    </div>
    @endsection

    @push('styles')
        @include('projects.style')
    @endpush

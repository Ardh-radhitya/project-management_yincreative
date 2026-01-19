    @extends('layout.main')

    @section('page-title', 'Tambah Proyek Baru')

    @section('content')
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

        {{-- HEADER CARD --}}
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6 class="font-bold text-slate-700">Form Pengajuan Proyek Baru</h6>
        </div>

        <div class="flex-auto p-6">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf

                {{-- 1. NAMA PROYEK --}}
                <div class="mb-6">
                    <label for="name" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                        Nama Proyek
                    </label>
                    <input type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Website E-Commerce, Desain Logo..."
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-purple-500 focus:outline-none @error('name') border-red-500 @enderror"
                        required />
                    @error('name')
                        <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p>
                    @enderror
                </div>

                {{-- 2. GRID KLIEN & KATEGORI (2 Kolom) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    {{-- Dropdown Klien --}}
                    <div>
                        <label for="client_id" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Klien
                        </label>
                        <div class="relative">
                            <select name="client_id" id="client_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Klien --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('client_id') <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p> @enderror
                    </div>

                    {{-- Dropdown Kategori --}}
                    <div>
                        <label for="category_id" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Kategori
                        </label>
                        <div class="relative">
                            <select name="category_id" id="category_id" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none cursor-pointer">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('category_id') <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- 3. GRID TANGGAL (2 Kolom) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="start_date" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Tanggal Mulai
                        </label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none" />
                        @error('start_date') <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Tanggal Selesai
                        </label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none" />
                        @error('end_date') <p class="mt-2 text-xs text-red-600 font-semibold">* {{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- 4. STATUS --}}
                <div class="mb-6">
                    <label for="status" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                        Status Awal
                    </label>
                    <div class="relative">
                        <select name="status" id="status" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500 focus:outline-none cursor-pointer">
                            <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                {{-- 5. DESKRIPSI --}}
                <div class="mb-6">
                    <label for="description" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase tracking-wide">
                        Deskripsi (Opsional)
                    </label>
                    <textarea name="description" id="description" rows="4" placeholder="Jelaskan detail proyek ini..." class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-purple-500 focus:outline-none">{{ old('description') }}</textarea>
                </div>

                {{-- 6. TOMBOL ACTION --}}
                <div class="flex items-center justify-end gap-3 mt-8">

                    {{-- Tombol Batal --}}
                    <a href="{{ route('projects.index') }}"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem shadow-soft-md hover:scale-102 hover:shadow-soft-xs active:opacity-85"
                    style="background-color: #a0aec0;">
                        Batal
                    </a>

                    {{-- Tombol Simpan --}}
                    <button type="submit"
                            class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-rem shadow-soft-md hover:scale-102 hover:shadow-soft-xs active:opacity-85"
                            style="background-image: linear-gradient(310deg, #7928CA 0%, #FF0080 100%); border: none;">
                        Simpan Proyek
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endsection

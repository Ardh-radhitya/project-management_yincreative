@extends('layout.main')

@section('page-title', 'Edit Proyek Saya')

@section('content')

<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:flex-none">

            <div class="relative z-20 flex min-w-0 flex-col break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                {{-- HEADER CARD --}}
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-solid border-black/12.5 rounded-t-2xl">
                    <h6 class="font-bold text-xl">Edit Proyek Saya</h6>
                    <p class="leading-normal text-sm text-slate-500">Perbarui detail proyek Anda. Status hanya dapat diubah oleh Admin.</p>
                </div>

                {{-- BODY FORM --}}
                <div class="flex-auto p-6">
                    <form action="{{ route('client.projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap -mx-3">

                            {{-- Input: Nama Proyek --}}
                            <div class="w-full max-w-full px-3 mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Proyek</label>
                                <input type="text" name="name" value="{{ old('name', $project->name) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" required />
                            </div>

                            {{-- Input: Klien (Otomatis Saya / Auth User) --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Klien (Saya)</label>
                                {{-- Input Tampilan (Disabled) --}}
                                <input type="text" value="{{ Auth::user()->name }}" disabled class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-500 cursor-not-allowed" />
                                {{-- Input Hidden (Data Asli) --}}
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                            </div>

                            {{-- Input: Kategori --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                                <div class="relative">
                                    <select name="category_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Input: Tanggal Mulai --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/3">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" />
                            </div>

                            {{-- Input: Tanggal Selesai --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/3">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" />
                            </div>

                            {{-- Input: Status (Read Only) --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/3">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                                <div class="relative">
                                    <input type="text" value="{{ $project->status }}" disabled class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-gray-100 bg-clip-padding px-3 py-2 font-normal text-gray-500 cursor-not-allowed capitalize" />
                                    <input type="hidden" name="status" value="{{ $project->status }}">
                                </div>
                            </div>

                            {{-- Input: Deskripsi --}}
                            <div class="w-full max-w-full px-3 mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Deskripsi</label>
                                <textarea name="description" rows="5" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow">{{ old('description', $project->description) }}</textarea>
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6">
                            {{-- Tombol Batal (Abu Terang) --}}
                            <a href="{{ route('projects.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs hover:bg-gray-300">
                                Batal
                            </a>
                            {{-- Tombol Simpan (Biru Solid) --}}
                            <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs" style="background-color: #5e72e4;">
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

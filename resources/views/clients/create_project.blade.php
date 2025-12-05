@extends('layout.main')

{{-- Mengirim judul halaman ke layout utama --}}
@section('page-title', 'Ajukan Proyek Baru')

@section('content')
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Ajukan Proyek Baru</h6>
    </div>
    <div class="flex-auto p-6">
        <form action="{{ route('client.projects.store') }}" method="POST">
            @csrf

            {{-- Input Nama Proyek --}}
            <div class="mb-4">
                <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Proyek</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama Proyek"
                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                    @error('name') border-red-500 focus:border-red-500 text-red-900 @else border-gray-300 @enderror" />

                @error('name')
                    <p class="mt-2 text-xs text-red-600 font-semibold flex items-center">
                        <i class="mr-1 fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Input Kategori --}}
            <div class="mb-4">
                <label for="category_id" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                <select name="category_id" id="category_id"
                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none
                    @error('category_id') border-red-500 focus:border-red-500 text-red-900 @else border-gray-300 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-xs text-red-600 font-semibold">
                        <i class="mr-1 fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Grid Tanggal --}}
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="start_date" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none
                        @error('start_date') border-red-500 focus:border-red-500 text-red-900 @else border-gray-300 @enderror" />
                    @error('start_date')
                        <p class="mt-2 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="end_date" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500 focus:outline-none
                        @error('end_date') border-red-500 focus:border-red-500 text-red-900 @else border-gray-300 @enderror" />
                    @error('end_date')
                        <p class="mt-2 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label for="description" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Deskripsi Brief</label>
                <textarea name="description" id="description" rows="4" placeholder="Jelaskan kebutuhan proyek Anda..."
                    class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none
                    @error('description') border-red-500 focus:border-red-500 text-red-900 @else border-gray-300 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-xs text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('dashboard.client') }}" class="px-6 py-3 mr-2 font-bold text-center text-black uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-slate-400 leading-pro text-xs ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-xs bg-blue-500 leading-pro text-xs ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">
                    Ajukan Proyek
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    {{-- Memanggil style form & tombol--}}
    @include('projects.style')
@endpush

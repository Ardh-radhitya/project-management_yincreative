@extends('layout.main')

@section('page-title', 'Ajukan Proyek Baru')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 shrink-0 md:flex-0 md:w-8/12 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                    <div class="flex items-center">
                        <p class="mb-0 font-bold text-lg">Form Pengajuan Proyek</p>
                    </div>
                </div>

                <div class="flex-auto p-6">
                    {{-- PERHATIKAN: enctype="multipart/form-data" WAJIB ADA --}}
                    <form action="{{ route('client.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Proyek --}}
                        <div class="mb-4">
                            <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Proyek</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required />
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            {{-- Kategori --}}
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0 mb-4">
                                <label for="category_id" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                                <select name="category_id" class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Deadline --}}
                            <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0 mb-4">
                                <label for="deadline" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tenggat Waktu (Deadline)</label>
                                <input type="date" name="deadline" value="{{ old('deadline') }}"
                                    class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required />
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label for="description" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Deskripsi Detail</label>
                            <textarea name="description" rows="4"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none">{{ old('description') }}</textarea>
                        </div>

                        {{-- [BARU] INPUT FILE --}}
                        <div class="mb-6 p-4 bg-gray-50 border border-dashed border-gray-300 rounded-lg">
                            <label for="attachments" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">
                                <i class="fas fa-paperclip mr-1"></i> Dokumen Referensi / Brief (Opsional)
                            </label>
                            <input type="file" name="attachments"
                                class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                            <p class="text-xs text-slate-400 mt-1 ml-1">*Format: PDF, Word, JPG, PNG (Max 5MB)</p>
                        </div>

                        <div class="text-right">
                            <a href="{{ route('dashboard.client') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-slate-400 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Batal</a>
                            <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-blue-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">Ajukan Proyek</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    {{-- Memanggil style form & tombol--}}
    @include('projects.style')
@endpush

@extends('layout.main')

{{-- Judul Halaman --}}
@section('page-title', 'Tambah Klien Baru')

@section('content')
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Tambah Klien Baru</h6>
    </div>
    <div class="flex-auto p-6">
        {{-- Form ini akan mengirim data ke route 'clients.store' --}}
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Nama Klien</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama Klien" class="form-input @error('name') border-red-500 @enderror" />
                {{-- Menampilkan error jika validasi 'name' gagal --}}
                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan Email Klien" class="form-input @error('email') border-red-500 @enderror" />
                {{-- Menampilkan error jika validasi 'email' gagal --}}
                @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="phone" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Telepon (Opsional)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Masukkan Nomor Telepon" class="form-input @error('phone') border-red-500 @enderror" />
                @error('phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="company" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Perusahaan (Opsional)</label>
                <input type="text" name="company" id="company" value="{{ old('company') }}" placeholder="Masukkan Nama Perusahaan" class="form-input @error('company') border-red-500 @enderror" />
                @error('company')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end mt-6">
                {{-- Tombol Batal kembali ke daftar klien --}}
                <a href="{{ route('clients.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Klien</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    {{-- Memanggil style form & tombol yang konsisten --}}
    @include('projects.style')
@endpush

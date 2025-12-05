@extends('layout.main')

@section('page-title', 'Edit Proyek')

@section('content')
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Edit Pengajuan Proyek: {{ $project->name }}</h6>
    </div>
    <div class="flex-auto p-6">
        {{-- Form ini akan dikirim ke route 'client.projects.update' --}}
        <form action="{{ route('client.projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Method PUT untuk update --}}

            {{-- Tampilkan error jika proyek tidak boleh diedit lagi --}}
            @if (session('error'))
                <div class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-red border-slate-100" role="alert">
                    <span class="font-bold">Error!</span> {{ session('error') }}
                </div>
            @endif

            <div class="mb-4">
                <label for="name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Nama Proyek</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" class="form-input @error('name') border-red-500 @enderror" />
                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Kategori</label>
                <select name="category_id" id="category_id" class="form-input @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="start_date" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Tanggal Mulai yang Diharapkan</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}" class="form-input @error('start_date') border-red-500 @enderror" />
                    @error('start_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="end_date" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Tanggal Selesai yang Diharapkan</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" class="form-input @error('end_date') border-red-500 @enderror" />
                    @error('end_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="description" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Deskripsi Brief Proyek</label>
                <textarea name="description" id="description" rows="4" class="form-input @error('description') border-red-500 @enderror">{{ old('description', $project->description) }}</textarea>
                @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end mt-6">
                <a href="{{ route('dashboard.client') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary" {{ $project->status !== 'Pending' ? 'disabled' : '' }}>Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

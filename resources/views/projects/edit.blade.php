@extends('layout.main')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Edit Proyek</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-6">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Nama Proyek</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" placeholder="Masukkan Nama Proyek" class="form-input @error('name') border-red-500 @enderror" />
                            @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="client_id" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Klien</label>
                            <select name="client_id" id="client_id" class="form-input @error('client_id') border-red-500 @enderror">
                                <option value="">Pilih Klien</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
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
                                <label for="start_date" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}" class="form-input @error('start_date') border-red-500 @enderror" />
                                @error('start_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="end_date" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" class="form-input @error('end_date') border-red-500 @enderror" />
                                @error('end_date')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="status" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Status</label>
                            <select name="status" id="status" class="form-input @error('status') border-red-500 @enderror">
                                <option value="">Pilih Status</option>
                                <option value="Pending" {{ old('status', $project->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ old('status', $project->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" rows="4" placeholder="Masukkan Deskripsi Proyek" class="form-input @error('description') border-red-500 @enderror">{{ old('description', $project->description) }}</textarea>
                            @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('projects.index') }}" class="btn-secondary">Batal</a>
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-input {
        @apply focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow;
    }
    .btn-primary {
        @apply inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-cyan hover:border-slate-700 hover:bg-slate-700 hover:text-white;
    }
    .btn-secondary {
        @apply inline-block px-6 py-3 mr-3 font-bold text-center uppercase align-middle transition-all bg-gray-200 border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 text-slate-800;
    }
</style>
@endpush

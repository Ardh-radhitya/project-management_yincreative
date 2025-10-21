@extends('layout.main')

@section('content')
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Tambah Tugas Baru untuk Proyek: {{ $project->name }}</h6>
    </div>
    <div class="flex-auto p-6">
        {{-- Form akan dikirim ke route 'projects.tasks.store' dengan parameter project --}}
        <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Judul Tugas</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Masukkan Judul Tugas" class="form-input @error('title') border-red-500 @enderror" />
                @error('title')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label for="description" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="3" placeholder="Masukkan Deskripsi Tugas" class="form-input @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
             <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="status" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Status Awal</label>
                    <select name="status" id="status" class="form-input @error('status') border-red-500 @enderror">
                        <option value="To Do" {{ old('status', 'To Do') == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                 <div class="mb-4">
                    <label for="assigned_to_user_id" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Tugaskan Kepada (Opsional)</label>
                    <select name="assigned_to_user_id" id="assigned_to_user_id" class="form-input @error('assigned_to_user_id') border-red-500 @enderror">
                        <option value="">Belum Ditugaskan</option>
                        @foreach ($teamMembers as $member)
                            <option value="{{ $member->id }}" {{ old('assigned_to_user_id') == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                        @endforeach
                    </select>
                    @error('assigned_to_user_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex justify-end mt-6">
                {{-- Tombol Batal kembali ke halaman detail proyek --}}
                <a href="{{ route('projects.show', $project->id) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Tugas</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

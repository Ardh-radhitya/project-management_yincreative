@extends('layout.main')

@section('page-title', 'Edit Tugas')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3 text-left">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">

                <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                    <h6 class="font-bold text-slate-700">Edit Tugas</h6>
                    <p class="text-sm">Proyek: <span class="font-bold">{{ $task->project->name }}</span></p>
                </div>

                <div class="flex-auto p-6">
                    {{-- Alert Error --}}
                    @if(session('error'))
                        <div class="p-3 mb-4 text-white bg-red-500 rounded-lg text-sm font-bold">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @php
                            $isDone = strtolower(trim($task->status)) === 'done';
                        @endphp

                        {{-- Kirim data asli lewat hidden input jika dropdown di-disable agar tidak error di controller --}}
                        @if($isDone)
                            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
                            <input type="hidden" name="status" value="{{ $task->status }}">
                        @endif

                        <div class="mb-4 text-left">
                            <label class="font-bold text-xs uppercase text-slate-700">Judul Tugas</label>
                            <input type="text" name="title" value="{{ old('title', $task->title) }}"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 p-2 outline-none focus:border-blue-500"
                                {{ $isDone ? 'readonly' : 'required' }}>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-4 text-left">
                            {{-- Dropdown Pilih Team --}}
                            <div class="w-full md:w-1/2 px-3 mb-4">
                                <label class="font-bold text-xs uppercase text-slate-700">Ditugaskan Ke</label>
                                <select name="user_id" {{ $isDone ? 'disabled' : '' }}
                                    class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 p-2 outline-none focus:border-blue-500 {{ $isDone ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $task->user_id == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($isDone) <p class="text-xxs text-red-500 mt-1">* Anggota tim tidak bisa diganti karena tugas selesai.</p> @endif
                            </div>

                            {{-- Dropdown Status --}}
                            <div class="w-full md:w-1/2 px-3">
                                <label class="font-bold text-xs uppercase text-slate-700">Status</label>
                                <select name="status" {{ $isDone ? 'disabled' : '' }}
                                    class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 p-2 outline-none focus:border-blue-500 {{ $isDone ? 'bg-gray-100 cursor-not-allowed' : '' }}">
                                    <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                    <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4 text-left">
                            <label class="font-bold text-xs uppercase text-slate-700">Deskripsi</label>
                            <textarea name="description" rows="4"
                                class="focus:shadow-primary-outline text-sm block w-full rounded-lg border border-gray-300 p-2 outline-none focus:border-blue-500"
                                {{ $isDone ? 'readonly' : '' }}>{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('projects.show', $task->project_id) }}" class="px-6 py-2 text-xs font-bold uppercase bg-gray-200 rounded-lg">Batal</a>

                            {{-- Sembunyikan tombol simpan atau biarkan saja (karena controller sudah nge-lock) --}}
                            <button type="submit" class="px-6 py-2 text-xs font-bold text-white uppercase bg-blue-500 rounded-lg shadow-md hover:scale-102 active:opacity-85" style="background-color: #5e72e4;">
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

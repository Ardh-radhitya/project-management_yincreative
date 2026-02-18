@extends('layout.main')

@section('page-title', 'Edit Tugas')

@section('content')
<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent text-left">
        <h6 class="font-bold text-slate-700">Edit Tugas: <span class="text-purple-600">{{ $task->title }}</span></h6>
    </div>

    <div class="flex-auto p-6">
        {{-- ACTION HARUS KE UPDATE, DENGAN DUA PARAMETER: PROJECT & TASK --}}
        <form action="{{ route('projects.tasks.update', [$project->id, $task->id]) }}" method="POST">
            @csrf
            @method('PUT')

                <div class="mb-6 text-left">
                    <label for="title" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase">Judul Tugas</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                        class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500" required>
                </div>

                <div class="mb-6 text-left">
                    <label for="description" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                            class="focus:shadow-primary-outline text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-purple-500">{{ old('description', $task->description) }}</textarea>
                </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6 text-left">
                {{-- DROPDOWN STATUS --}}
                <div>
                    <label for="status" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase">Status</label>
                    <select name="status" id="status" class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 outline-none focus:border-purple-500">
                        <option value="To Do" {{ old('status', $task->status) == 'To Do' ? 'selected' : '' }}>To Do</option>
                        <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Done" {{ old('status', $task->status) == 'Done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                {{-- DROPDOWN TEAM MEMBER --}}
                <div>
                    <label for="assigned_to_user_id" class="block mb-2 ml-1 text-xs font-bold text-slate-700 uppercase">Tugaskan Kepada</label>
                    <select name="assigned_to_user_id" id="assigned_to_user_id"
                            class="focus:shadow-primary-outline text-sm ease block w-full rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 outline-none focus:border-purple-500" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach ($teams as $member)
                            <option value="{{ $member->id }}"
                                {{ old('assigned_to_user_id', $task->user_id) == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8">
                <a href="{{ route('projects.show', $project->id) }}" class="inline-block px-6 py-3 font-bold text-center text-gray-700 uppercase bg-gray-200 rounded-lg text-xs">Batal</a>
                <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase bg-blue-500 rounded-lg text-xs" style="background-color: #5e72e4;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection

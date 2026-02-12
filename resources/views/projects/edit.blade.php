@extends('layout.main')

@section('page-title', 'Edit Proyek')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:flex-none">
            <div class="relative z-20 flex min-w-0 flex-col break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-solid border-black/12.5 rounded-t-2xl">
                    <h6 class="font-bold text-xl">Edit Proyek Saya</h6>
                    <p class="leading-normal text-sm text-slate-500">Perbarui detail proyek Anda.</p>
                </div>

                <div class="flex-auto p-6">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- WAJIB: Biar gak error "client id is required" --}}
                        <input type="hidden" name="client_id" value="{{ $project->client_id }}">

                        <div class="flex flex-wrap -mx-3">
                            {{-- Nama Proyek --}}
                            <div class="w-full max-w-full px-3 mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Proyek</label>
                                <input type="text" name="name" value="{{ old('name', $project->name) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 outline-none" required />
                            </div>

                            {{-- Dropdown Team --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Ditugaskan ke (Team)</label>
                                <select name="user_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 outline-none">
                                    <option value="">-- Pilih Team --</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}" {{ $project->user_id == $team->id ? 'selected' : '' }}>
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Kategori --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Kategori</label>
                                <select name="category_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 outline-none">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $project->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanggal --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700" />
                            </div>
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700" />
                            </div>

                            {{-- Status --}}
                            <div class="w-full max-w-full px-3 mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                                <select name="status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 outline-none transition-all focus:border-blue-500">
                                    <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="w-full max-w-full px-3 mb-4">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Deskripsi</label>
                                <textarea name="description" rows="5" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500">{{ old('description', $project->description) }}</textarea>
                            </div>
                        </div>

                        {{-- TOMBOL: Pastikan di dalem Form --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('projects.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer text-xs shadow-soft-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer text-xs shadow-soft-md" style="background-color: #5e72e4;">
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

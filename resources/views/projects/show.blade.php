@extends('layout.main')

@section('content')
{{-- Notifikasi Sukses (jika ada setelah menambah/mengedit tugas) --}}
@if (session('success'))
    <div class="alert-success mb-6" role="alert">
        <span class="font-bold">Sukses!</span> {{ session('success') }}
    </div>
@endif

<div class="flex flex-wrap -mx-3">
    {{-- Kartu Detail Proyek --}}
    <div class="w-full max-w-full px-3 mb-6 lg:w-1/2 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex justify-between items-center">
                    <h6 class="mb-0">{{ $project->name }}</h6>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn-action-edit">Edit Proyek</a>
                </div>
            </div>
            <div class="flex-auto p-6">
                <p class="leading-normal text-size-sm"><strong>Klien:</strong> {{ $project->client->name ?? 'N/A' }}</p>
                <p class="leading-normal text-size-sm"><strong>Kategori:</strong> {{ $project->category->name ?? 'N/A' }}</p>
                <p class="leading-normal text-size-sm"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</p>
                <p class="leading-normal text-size-sm"><strong>Status:</strong> <span class="font-semibold">{{ $project->status }}</span></p>
                <hr class="h-px my-4 bg-transparent bg-gradient-horizontal-dark">
                <p class="leading-normal text-size-sm"><strong>Deskripsi:</strong></p>
                <p class="leading-normal text-size-sm">{{ $project->description ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu Daftar Tugas --}}
    <div class="w-full max-w-full px-3 mb-6 lg:w-1/2 lg:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                 <div class="flex justify-between items-center">
                    <h6 class="mb-0">Daftar Tugas</h6>
                    <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn-primary">Tambah Tugas</a>
                </div>
            </div>
            <div class="flex-auto p-6">
                {{-- PERUBAHAN DI SINI: Tabel untuk menampilkan daftar tugas --}}
                @if ($project->tasks->isEmpty())
                    <p class="text-center text-gray-500">Belum ada tugas untuk proyek ini.</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($project->tasks as $task)
                            <li class="py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $task->title }}</h4>
                                        <p class="text-xs text-gray-500">
                                            Status: {{ $task->status }} | Ditugaskan ke: {{ $task->assignedUser->name ?? 'Belum ditugaskan' }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        {{-- Tombol Edit Task (akan kita buat fungsinya nanti) --}}
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action-edit mr-2">Edit</a>
                                        {{-- Tombol Hapus Task (akan kita buat fungsinya nanti) --}}
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin hapus tugas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                @if($task->description)
                                <p class="mt-2 text-xs text-gray-600">{{ $task->description }}</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

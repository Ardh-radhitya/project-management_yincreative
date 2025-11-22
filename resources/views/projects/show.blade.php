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
                {{-- Tabel untuk menampilkan daftar tugas --}}
                @if ($project->tasks->isEmpty())
                    <p class="text-center text-gray-500">Belum ada tugas untuk proyek ini.</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($project->tasks as $task)
                            <li class="py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $task->title }}</h4>
                                        <p class="text-xs text-gray-500">
                                            Ditugaskan ke: {{ $task->assignedUser->name ?? 'Belum ditugaskan' }}
                                        </p>
                                    </div>

                                    {{-- Form Update Status (Kode Lama) --}}
                                    <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-input text-xs mr-2 py-1 px-2" onchange="this.form.submit()">
                                            <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
                                            <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Done" {{ $task->status == 'Done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                    </form>
                                </div>

                                @if($task->description)
                                <p class="mt-2 text-xs text-gray-600 italic">{{ $task->description }}</p>
                                @endif

                                {{-- Tombol Aksi (Kode Lama) --}}
                                <div class="flex items-center justify-end mt-2 space-x-2">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn-action-edit">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete">Hapus</button>
                                    </form>
                                </div>

                                {{-- FITUR BARU: KOLOM LAPORAN PROGRESS --}}
                                <div class="mt-4 bg-gray-50 p-3 rounded-lg">
                                    <h6 class="text-xs font-bold text-slate-700 mb-2">Riwayat Laporan Progress:</h6>

                                    {{-- Daftar Laporan Sebelumnya --}}
                                    <ul class="mb-3 space-y-2">
                                        @forelse($task->progress as $progress)
                                            <li class="text-xs border-l-2 border-blue-500 pl-2">
                                                <span class="font-semibold text-slate-800">{{ $progress->user->name }}:</span>
                                                <span class="text-slate-600">{{ $progress->progress_note }}</span>
                                                <span class="text-[10px] text-gray-400 block">{{ $progress->created_at->diffForHumans() }}</span>
                                            </li>
                                        @empty
                                            <li class="text-xs text-gray-400">- Belum ada laporan -</li>
                                        @endforelse
                                    </ul>

                                    {{-- Form Input Laporan Baru --}}
                                    <form action="{{ route('tasks.progress.store', $task->id) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <input type="text" name="progress_note" placeholder="Tulis laporan progress..." class="form-input text-xs w-full" required>
                                        <button type="submit" class="btn-primary py-1 px-3 text-xs">Kirim</button>
                                    </form>
                                </div>
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

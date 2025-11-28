@extends('layout.main')

{{-- Mengirim judul halaman ke layout utama --}}
@section('page-title', 'Team Dashboard')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    {{-- Sambutan dinamis dengan nama user --}}
    <h3 class="font-bold text-white text-3xl">Welcome back, {{ Auth::user()->name }}!</h3>
    <p class="text-white mb-6">Here's your task and project overview for today.</p>

    <div class="flex flex-wrap -mx-3">
        {{-- Bagian Proyek Aktif Saya --}}
        <div class="w-full max-w-full px-3 mt-0 lg:w-8/12 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">Proyek Aktif Saya</h6>
                </div>
                <div class="flex-auto p-4">
                    {{-- Loop untuk $myProjects --}}
                    @forelse ($myProjects as $project)
                        <div class="p-4 mb-4 border rounded-lg">
                            <h5 class="font-semibold">{{ $project->name }}</h5>
                            <p class="text-sm text-gray-500">Klien: {{ $project->client->name ?? 'N/A' }}</p>
                            <div class="flex justify-between items-center mt-2">
                                {{-- Hitung jumlah tugas yang belum selesai untuk user ini di proyek ini --}}
                                @php
                                    $userTaskCount = $project->tasks()->where('assigned_to_user_id', Auth::id())->where('status', '!=', 'Done')->count();
                                @endphp
                                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200">
                                    {{ $userTaskCount }} Tugas Anda Menunggu
                                </span>
                                <a href="{{ route('projects.show', $project->id) }}" class="text-sm font-bold text-blue-500 hover:underline">View Details</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Anda sedang tidak memiliki proyek yang aktif.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Bagian Tugas Saya Hari Ini --}}
        <div class="w-full max-w-full px-3 mt-6 lg:mt-0 lg:w-4/12 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                    <h6 class="capitalize dark:text-white">Tugas Saya (To Do)</h6>
                </div>
                <div class="flex-auto p-4">
                    {{-- Loop untuk $myTasks --}}
                    @forelse ($myTasks as $task)
                        <div class="p-3 mb-2 border rounded-lg">
                            <label class="font-medium text-gray-900 dark:text-gray-300">{{ $task->title }}</label>
                            <p class="text-xs text-gray-500">
                                Status: {{ $task->status }}
                                {{-- Link ke halaman detail proyek tempat tugas ini berada --}}
                                | <a href="{{ route('projects.show', $task->project_id) }}" class="text-blue-500 hover:underline">Lihat Proyek</a>
                            </p>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada tugas yang ditugaskan untuk Anda.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

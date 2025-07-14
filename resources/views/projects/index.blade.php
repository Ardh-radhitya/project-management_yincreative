@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Projects Management</h3>
            <p class="text-white">Add, view, and manage project entries.</p>
        </div>
        <div>
            <a href="{{ route('projects.create') }}" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + New Project
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-white rounded-lg bg-green-500 shadow" role="alert">
            <strong class="font-bold">Success!</strong> {{ session('success') }}
        </div>
    @endif


    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Title</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Client</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Start Date</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">End Date</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <span class="text-sm font-semibold dark:text-white">{{ $project->title }}</span>
                            </td>
                            <td class="text-sm text-gray-700 dark:text-white">
                                {{ $project->category->name ?? '-' }}
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <span class="text-sm text-slate-500 dark:text-white/80">
                                    {{ optional($project->client)->name ?? '-' }}
                                </span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <span class="text-xs font-semibold dark:text-white/80 text-slate-400">{{ $project->start_date ?? '-' }}</span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <span class="text-xs font-semibold dark:text-white/80 text-slate-400">{{ $project->end_date ?? '-' }}</span>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <span class="text-xs font-semibold
                                    @if ($project->status === 'Completed')
                                        text-green-600 bg-green-100 px-2 py-1 rounded-full
                                    @elseif ($project->status === 'In Progress')
                                        text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full
                                    @else
                                        text-red-600 bg-red-100 px-2 py-1 rounded-full
                                    @endif
                                ">
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                <div class="flex justify-center items-center">
                                    <a href="{{ url('projects/' . $project->id) }}" class="text-xs font-semibold leading-tight dark:text-white/80 text-slate-400 mr-4"> Edit </a>
                                    <form action="{{ url('projects/' . $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs font-semibold text-red-600 hover:underline hover:text-red-800 dark:text-red-400 dark:hover:text-red-200 transition duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-sm text-gray-500">
                                No projects found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection



<!-- Tailwind safelist trick biar warna kebaca -->
<div class="hidden">
    text-green-600 bg-green-100
    text-yellow-600 bg-yellow-100
    text-red-600 bg-red-100
</div>

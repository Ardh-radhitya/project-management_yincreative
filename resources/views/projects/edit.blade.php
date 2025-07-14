@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Edit Project</h3>
            <p class="text-white">Modify the project details below.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <strong>There were some problems with your input:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white dark:bg-slate-850 p-6 rounded-xl shadow-xl">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Project Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white" required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white">{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- Client --}}
            <div class="mb-4">
                <label for="client_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
                <select name="client_id" id="client_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white">
                    <option value="">-- Select Client --</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Start Date --}}
            <div class="mb-4">
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white">
            </div>

            {{-- End Date --}}
            <div class="mb-4">
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white">
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-slate-800 dark:border-gray-600 dark:text-white">
                    <option value="Not Started" {{ old('status', $project->status) == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                    <option value="In Progress" {{ old('status', $project->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label for="category_id" class="block mb-1 font-medium">Project Category</label>
                <select name="category_id" id="category_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hidden Input for Project ID --}}


            {{-- Buttons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('projects.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Update Project</button>
            </div>
        </form>
    </div>
</div>
@endsection

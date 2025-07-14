@extends('layout.main')

@section('content')
<div class="px-6 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-3xl">Project Categories</h3>
            <p class="text-slate-500">Manage project categories for better organization.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="text-sm bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            + New Category
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow p-4">
        <ul>
            @forelse($categories as $category)
                <li class="flex justify-between py-2 border-b">
                    <span>{{ $category->name }}</span>
                    <div class="space-x-4">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="text-gray-500 text-center py-4">No categories found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h3 class="font-bold text-2xl mb-4 text-white">Add Project Category</h3>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="text-white">Category Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 rounded" placeholder="e.g. Design" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save Category
        </button>
    </form>
</div>
@endsection

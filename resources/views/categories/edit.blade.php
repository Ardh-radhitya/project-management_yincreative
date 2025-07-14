@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <h3 class="font-bold text-2xl mb-4 text-white">Edit Category</h3>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="text-white">Category Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="w-full p-2 rounded" required>
        </div>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Update Category
        </button>
    </form>
</div>
@endsection

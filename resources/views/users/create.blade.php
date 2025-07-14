@extends('layout.main')

@section('content')
<div class="p-6">
    <h3 class="text-2xl font-bold mb-4">Add New User</h3>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-white font-medium mb-1">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 rounded bg-white text-black" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 rounded bg-white text-black" required>
        </div>

        <div class="mb-4">
            <label for="role_id" class="block text-gray-500 font-medium mb-1">Select Role</label>
            <select name="role_id" id="role_id" class="w-full p-2 rounded bg-white text-black" required>
                <option value="1">Admin</option>
                <option value="2">Internal Team</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-500 font-medium mb-1">Password</label>
            <input type="password" name="password" id="password" class="w-full p-2 rounded bg-white text-black" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-500 font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 rounded bg-white text-black" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded mt-4">
            Save
        </button>

    </form>
</div>
@endsection

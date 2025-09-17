
@extends('layout.main')

@section('content')
<div class="px-6 py-6 max-w-lg">
    <h3 class="font-bold text-2xl mb-4">Profile & Security</h3>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}"
            class="border rounded w-full p-2">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
            class="border rounded w-full p-2">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">New Password (optional)</label>
            <input type="password" name="password" class="border rounded w-full p-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="border rounded w-full p-2">
        </div>

        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Save Changes
        </button>
    </form>
</div>
@endsection

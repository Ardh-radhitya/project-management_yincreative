@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Edit Pengguna</h3>
            <p class="text-white">Perbarui data pengguna</p>
        </div>
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        {{-- Role
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="role">Role</label>
            <select name="role" id="role"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="tim" {{ $user->role === 'tim' ? 'selected' : '' }}>Tim Internal</option>
                <option value="klien" {{ $user->role === 'klien' ? 'selected' : '' }}>Klien</option>
            </select>
        </div> --}}

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <a href="{{ route('users.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Batal</a>
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">Simpan</button>
        </div>
    </form>
</div>
@endsection

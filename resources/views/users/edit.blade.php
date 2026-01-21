@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:flex-none">

            <div class="relative z-20 flex min-w-0 flex-col break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                {{-- HEADER CARD --}}
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-solid border-black/12.5 rounded-t-2xl">
                    <h6 class="font-bold">Edit User</h6>
                    <p class="leading-normal text-sm text-slate-500">Perbarui data pengguna dan hak akses.</p>
                </div>

                {{-- BODY FORM --}}
                <div class="flex-auto p-6">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap -mx-3">

                            {{-- Input: Nama Lengkap --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" required />
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input: Email --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" required />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input: Password (Opsional) --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password (Opsional)</label>
                                <input type="password" name="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Kosongkan jika tidak ingin diubah" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input: Role (Dropdown) --}}
                            {{-- PENTING: Pastikan value option sesuai database lu (misal: 'admin', 'client', 'team' atau ID 1, 2, 3) --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Role / Hak Akses</label>
                                <div class="relative">
                                    <select name="role" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow">
                                        <option value="admin" {{ (old('role', $user->role) == 'admin' || $user->role == 'Admin') ? 'selected' : '' }}>Admin</option>
                                        <option value="client" {{ (old('role', $user->role) == 'client' || $user->role == 'Client') ? 'selected' : '' }}>Client</option>
                                        <option value="team" {{ (old('role', $user->role) == 'team' || $user->role == 'Team') ? 'selected' : '' }}>Team</option>
                                    </select>
                                    {{-- Panah Dropdown Custom (Opsional biar cantik) --}}
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('users.index') }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs" style="background-color: #5e72e4;">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

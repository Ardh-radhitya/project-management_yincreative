@extends('layout.main')

@section('page-title', 'Manajemen User')

@section('content')

<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    {{-- HEADER (Style Persis Projects) --}}
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="flex justify-between items-center">
            <h6 class="mb-0">Tabel User</h6>

            {{-- TOMBOL TAMBAH (Sama persis class-nya) --}}
            <a href="{{ route('users.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer shadow-md hover:shadow-lg hover:bg-blue-600 active:opacity-85">
                + Tambah User
            </a>
        </div>
    </div>

    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">User / Email</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Role</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bergabung</th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        {{-- KOLOM NAMA --}}
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <div>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=32" class="inline-flex items-center justify-center mr-2 text-white transition-all duration-200 ease-in-out text-sm h-9 w-9 rounded-xl shadow-soft-lg" alt="user1" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 text-sm leading-normal font-semibold hover:text-blue-500">{{ $user->name }}</h6>
                                    <p class="mb-0 text-xs leading-tight text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- KOLOM ROLE (FIX: Pakai Inline Style Biar Pasti Muncul) --}}
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            @php
                                // Ambil nama role, lowercase biar gampang dicek
                                $roleName = strtolower($user->role->name ?? '');

                                // Tentukan Style Manual (Anti-Gagal)
                                $roleStyle = match(true) {
                                    // ADMIN -> Hitam/Dark
                                    $roleName == 'admin' || $roleName == 'administrator'
                                        => 'background: linear-gradient(310deg, #141727 0%, #3a416f 100%); color: #ffffff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.2);',

                                    // TEAM -> Biru/Info
                                    $roleName == 'team' || $roleName == 'staff'
                                        => 'background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); color: #ffffff; box-shadow: 0 4px 6px -1px rgba(33,82,255,0.3);',

                                    // CLIENT -> Orange/Warning
                                    $roleName == 'client' || $roleName == 'klien'
                                        => 'background: linear-gradient(310deg, #fb6340 0%, #fbb140 100%); color: #ffffff; box-shadow: 0 4px 6px -1px rgba(251,99,64,0.3);',

                                    // Default -> Abu-abu
                                    default
                                        => 'background: #cbd5e0; color: #ffffff;',
                                };
                            @endphp

                            <span style="{{ $roleStyle }}" class="px-3 py-2 rounded-lg text-xs font-bold uppercase inline-block leading-none">
                                {{ $user->role->name ?? 'GUEST' }}
                            </span>
                        </td>

                        {{-- KOLOM TANGGAL --}}
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>

                        {{-- KOLOM AKSI --}}
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex items-center justify-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('users.edit', $user->id) }}" class="mr-2 font-bold text-xs text-blue-500 hover:text-blue-700 uppercase" style="cursor: pointer;">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                @if(auth()->user()->id !== $user->id)
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user {{ $user->name }}?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-bold text-xs text-red-500 hover:text-red-700 uppercase border-0 bg-transparent p-0" style="cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @include('users.style')
@endpush

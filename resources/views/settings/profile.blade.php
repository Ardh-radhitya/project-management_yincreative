@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:flex-none">

            <div class="relative z-20 flex min-w-0 flex-col break-words bg-white border-0 border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                {{-- HEADER CARD --}}
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-solid border-black/12.5 rounded-t-2xl">
                    <h6 class="font-bold text-xl">Profil & Keamanan</h6>
                    <p class="leading-normal text-sm text-slate-500">Perbarui informasi pribadi dan pengaturan keamanan akun Anda.</p>
                </div>

                {{-- ALERT SUCCESS (Jika ada) --}}
                @if(session('success'))
                    <div class="px-6 pt-4">
                        <div class="alert flex rounded-lg bg-green-100 px-4 py-4 text-green-700 border-green-200 border" role="alert">
                            <i class="fas fa-check-circle mr-2 mt-1"></i>
                            <span class="font-semibold text-sm">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                {{-- BODY FORM --}}
                <div class="flex-auto p-6">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-wrap -mx-3">

                            {{-- BAGIAN 1: INFORMASI AKUN --}}
                            <div class="w-full px-3 mb-4">
                                <h6 class="font-bold text-xs text-blue-500 uppercase tracking-wide">Informasi Akun</h6>
                                <hr class="h-px mt-0 mb-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                            </div>

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
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" required />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- BAGIAN 2: KEAMANAN --}}
                            <div class="w-full px-3 mt-4 mb-4">
                                <h6 class="font-bold text-xs text-blue-500 uppercase tracking-wide">Keamanan (Opsional)</h6>
                                <hr class="h-px mt-0 mb-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                            </div>

                            {{-- Input: Password Baru --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Password Baru</label>
                                <input type="password" name="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Kosongkan jika tidak ingin mengubah password" />
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Input: Konfirmasi Password --}}
                            <div class="w-full max-w-full px-3 mb-4 md:w-1/2">
                                <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Ketik ulang password baru" />
                            </div>

                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-6">
                            {{-- Tombol Batal (Abu Terang - Konsisten) --}}
                            <a href="{{ url()->previous() }}" class="inline-block px-6 py-3 mr-3 font-bold text-center text-gray-700 uppercase align-middle transition-all bg-gray-200 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md hover:scale-102 hover:shadow-soft-xs hover:bg-gray-300">
                                Batal
                            </a>
                            {{-- Tombol Simpan --}}
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

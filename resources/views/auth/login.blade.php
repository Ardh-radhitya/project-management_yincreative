@extends('layout.auth')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:w-1/2 shrink-0 md:w-9/12 md:flex-0">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-none lg:py-4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                <div class="flex-auto p-6 text-center">
                    <img src="{{ asset('argon-template/build/assets/img/logoyin.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 100px;">
                    <h4 class="mb-1 font-bold">Login</h4>
                    <p class="mb-0">Masukan email dan password kamu untuk login</p>
                </div>

                <div class="flex-auto p-6 pt-0">
                    <form role="form" method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                <div class="mb-4">
                                    <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="eg. soft@dashboard.com" required
                                        class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" />

                                    {{-- KODE INI AKAN MENAMPILKAN PESAN ERROR JIKA LOGIN GAGAL --}}
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                <div class="mb-4">
                                    <label for="password" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Password</label>
                                    <input type="password" id="password" name="password" placeholder="••••••••" required
                                        class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" />
                                </div>
                            </div>
                            <div class="w-full max-w-full px-3 mt-4 shrink-0 md:w-full md:flex-0">
                                <div class="text-center">
                                    <button type="submit"
                                        class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-cyan hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

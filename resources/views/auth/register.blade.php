@extends('layout.auth')

@section('title', 'Daftar - Y.in Creative')

@section('content')
<section class="min-h-screen">
    <div class="bg-top relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-cover min-h-50-screen rounded-xl bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg')]">
        <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-zinc-800 to-zinc-700 opacity-60"></span>
        <div class="container z-10">
            <div class="flex flex-wrap justify-center -mx-3">
                <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                    <h1 class="mt-12 mb-2 text-white">Selamat Datang!</h1>
                    <p class="text-white">Buat akun baru untuk mulai berkolaborasi di platform Y.in Creative.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">

                    <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                        <h5>Daftar Akun Baru</h5>
                    </div>

                    <div class="flex-auto p-6">
                        {{-- Form Register Laravel --}}
                        <form role="form text-left" method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Nama --}}
                            <div class="mb-4">
                                <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus
                                    class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none @error('name') border-red-500 @enderror" />
                                @error('name')
                                    <div class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-4">
                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                                    class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none @error('email') border-red-500 @enderror" />
                                @error('email')
                                    <div class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-4">
                                <input type="password" name="password" placeholder="Password" required
                                    class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none @error('password') border-red-500 @enderror" />
                                @error('password')
                                    <div class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-4">
                                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
                                    class="placeholder:text-gray-500 text-sm focus:shadow-primary-outline leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-blue-500 focus:bg-white focus:text-gray-700 focus:outline-none" />
                            </div>

                            {{-- Checkbox Terms (Opsional, tapi ada di template) --}}
                            <div class="min-h-6 pl-7 mb-0.5 block">
                                <input id="terms" class="w-4.8 h-4.8 ease -ml-7 rounded-1.4 checked:bg-gradient-to-tl checked:from-blue-500 checked:to-violet-500 after:text-xxs after:font-awesome after:duration-250 after:ease-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" required />
                                <label class="mb-2 ml-1 font-normal cursor-pointer text-sm text-slate-700" for="terms"> Saya setuju dengan <a href="javascript:;" class="font-bold text-slate-700">Syarat dan Ketentuan</a> </label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="inline-block w-full px-5 py-2.5 mt-6 mb-2 font-bold text-center text-white align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:-translate-y-px hover:shadow-xs leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                    Daftar Sekarang
                                </button>
                            </div>

                            <p class="mt-4 mb-0 leading-normal text-sm text-center">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-slate-700">Masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

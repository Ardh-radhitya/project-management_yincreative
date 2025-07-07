@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <h3 class="font-bold text-2xl mb-4 dark:text-white">Add New Client</h3>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">There's something wrong!</strong>
                    <ul class="list-disc pl-5 mt-2 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Client Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="e.g., Acme Corporation"
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 font-normal text-gray-700 placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="e.g., contact@acme.com"
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 font-normal text-gray-700 placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Password</label>
                    <input type="password" name="password" id="password" placeholder="********"
                        class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 font-normal text-gray-700 placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" />
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photo Profile --}}
                <div class="mb-4">
                    <label for="photo_profile" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Profile Picture</label>
                    <input type="file" name="photo_profile" id="photo_profile"
                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    @error('photo_profile')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end mt-6">
                    <a href="{{ route('clients.index') }}"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-xs px-5 py-2.5 mb-2 uppercase">
                        Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

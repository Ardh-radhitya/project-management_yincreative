@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <h3 class="font-bold text-2xl mb-4 dark:text-white">Add New Client</h3>

            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Client Name</label>
                    <input type="text" name="name" id="name" placeholder="e.g., Acme Corporation" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required />
                </div>

                <div class="mb-4">
                    <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email</label>
                    <input type="email" name="email" id="email" placeholder="e.g., contact@acme.com" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required />
                </div>

                <div class="mb-4">
                    <label for="password" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Password</label>
                    <input type="password" name="password" id="password" placeholder="********" class="focus:shadow-primary-outline dark:bg-slate-850 dark:text-white text-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none" required />
                </div>

                <div class="mb-4">
                    <label for="photo_profile" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Profile Picture</label>
                    <input type="file" name="photo_profile" id="photo_profile" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('clients.index') }}" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</a>
                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-xs px-5 py-2.5 mr-2 mb-2 uppercase">Save Client</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <h3 class="font-bold text-2xl mb-4 dark:text-white">Edit Client: {{ $client->name }}</h3>
            <form action="{{ route('clients.update', $client->clients_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client Name</label>
                    <input type="text" name="name" id="name" class="block w-full p-2.5 text-sm rounded-lg border border-gray-300" value="{{ $client->name }}" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email" class="block w-full p-2.5 text-sm rounded-lg border border-gray-300" value="{{ $client->email }}" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                    <input type="password" name="password" id="password" class="block w-full p-2.5 text-sm rounded-lg border border-gray-300" placeholder="Leave blank to keep current password">
                </div>
                <div class="mb-4">
                    <label for="photo_profile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Picture</label>
                    <input type="file" name="photo_profile" id="photo_profile" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    @if ($client->photo_profile)
                        <img src="{{ asset('storage/' . $client->photo_profile) }}" alt="Profile Picture" class="w-20 h-20 mt-2 rounded-full">
                    @endif
                </div>
                <div class="flex items-center">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Update Client</button>
                    <a href="{{ route('clients.index') }}" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

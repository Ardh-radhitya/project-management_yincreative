@extends('layout.main') {{-- kalau lo mau bikin layout auth sendiri, lebih ringan dari main dashboard --}}

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" required
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring focus:ring-indigo-200">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                Masuk
            </button>
        </form>
    </div>
</div>
@endsection

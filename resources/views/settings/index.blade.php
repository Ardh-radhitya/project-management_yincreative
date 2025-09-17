@extends('layout.main')

@section('content')
<div class="px-6 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-3xl">Settings</h3>
            <p class="text-slate-900">Manage your account and system preferences.</p>
        </div>
    </div>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-4">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('settings.profile') }}" class="text-blue-600 hover:underline">
                    Profile & Security
                </a>
            </li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li>
                        <a href="{{ route('settings.system') }}" class="text-blue-600 hover:underline">
                            System Settings
                        </a>
                    </li>
                @endif
            @endauth
            <li>
                <a href="{{ route('settings.notifications') }}" class="text-blue-600 hover:underline">
                    Notifications
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

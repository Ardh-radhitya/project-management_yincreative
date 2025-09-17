@extends('layout.main')

@section('content')
<div class="px-6 py-6 max-w-lg">
    <h3 class="font-bold text-2xl mb-4">Notification Settings</h3>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.notifications.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <label class="flex items-center space-x-2">
            <input type="checkbox" name="email_notif" value="1"
                {{ old('email_notif', $user->email_notif ?? false) ? 'checked' : '' }}>
            <span>Email Notifications</span>
        </label>

        <label class="flex items-center space-x-2">
            <input type="checkbox" name="system_notif" value="1"
                {{ old('system_notif', $user->system_notif ?? false) ? 'checked' : '' }}>
            <span>System Alerts</span>
        </label>

        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Save Changes
        </button>
    </form>
</div>
@endsection

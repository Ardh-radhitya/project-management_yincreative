@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">User Management</h3>
            <p class="text-white">Add, view, and manage user accounts.</p>
        </div>
        <div>
            <a href="{{ route('users.create') }}" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + New User
            </a>
        </div>
    </div>
    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">User</th>
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Role</th>
                            {{-- <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th> --}}
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Joined</th>
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('assets/img/user-default.jpg') }}" class="inline-flex items-center justify-center mr-4 h-9 w-9 rounded-xl" alt="user" />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $user->name }}</h6>
                                        <p class="mb-0 text-xs leading-tight dark:text-white/80 text-slate-400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white/80">
                                    {{ $user->role_id == 1 ? 'Admin' : ($user->role_id == 2 ? 'Internal Team' : 'Unknown') }}
                                </p>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight dark:text-white/80 text-slate-400">
                                    {{ $user->created_at->format('d/m/y') }}
                                </span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-xs font-semibold leading-tight dark:text-white/80 text-blue-500"> Edit </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-400 py-4">Belum ada user.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

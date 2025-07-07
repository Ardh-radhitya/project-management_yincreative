@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="font-bold text-white text-3xl">Clients Management</h3>
            <p class="text-white">Add, view, and manage client accounts.</p>
        </div>
        <div>
            <a href="{{ route('clients.create') }}" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer hover:bg-blue-600">
                + New Client
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @endif

    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Clients</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Joined</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div>
                                        <img src="{{ $client->photo_profile ? asset('storage/' . $client->photo_profile) : asset('assets/img/team-2.jpg') }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $client->name }}</h6>
                                        <p class="mb-0 text-xs leading-tight dark:text-white/80 text-slate-400">{{ $client->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold leading-tight dark:text-white/80 text-slate-400">{{ $client->created_at->format('d/m/y') }}</span>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div class="flex justify-center items-center">
                                    <a href="{{ route('clients.edit', $client->clients_id) }}" class="text-xs font-semibold leading-tight dark:text-white/80 text-slate-400 mr-4"> Edit </a>

                                    <form action="{{ route('clients.destroy', $client->clients_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold leading-tight text-red-500">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="3" class="p-4 text-center text-sm text-gray-500">
                               No clients found.
                           </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

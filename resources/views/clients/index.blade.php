@extends('layout.main')

@section('content')



<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="flex justify-between items-center">
            <h6 class="mb-0">Tabel Klien</h6>
            <a href="{{ route('clients.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer shadow-md hover:shadow-lg hover:bg-blue-600 active:opacity-85">
            + Tambah Klien
        </a>
        </div>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Klien</th>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email & Telepon</th>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Perusahaan</th>
                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <h6 class="mb-0 text-size-sm leading-normal">{{ $client->name }}</h6>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex flex-col justify-center">
                                <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $client->email }}</p>
                                <p class="mb-0 leading-tight text-slate-400 text-size-xs">{{ $client->phone ?? '' }}</p>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <p class="mb-0 font-semibold leading-tight text-size-xs">{{ $client->company ?? '-' }}</p>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                            {{-- Edit Client --}}
                            <a href="{{ route('clients.edit', $client->id) }}"
                            class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                            style="background-color: #344767; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; margin-right: 4px;">
                                Edit
                            </a>

                            {{-- Delete Client --}}
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus data klien ini? Akses login mereka akan hilang.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                                        style="background-color: #f5365c; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: none;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data klien.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    @include('projects.style')
@endpush

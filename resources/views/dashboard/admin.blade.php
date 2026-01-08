@extends('layout.main')

@section('page-title', 'Dashboard Admin')

@section('content')

    {{-- BARIS 1: STATISTIK STATUS PROYEK (GRID 4 KOLOM) --}}
    <div class="flex flex-wrap -mx-3 mb-6">

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Proyek Dikerjakan</p>
                                <h5 class="mb-0 font-bold">{{ $totalProjects }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                <i class="ni ni-briefcase-24 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Pending</p>
                                <h5 class="mb-0 font-bold">{{ $pendingProjects }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-gray-600 to-slate-400">
                                <i class="ni ni-time-alarm text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">On Progress</p>
                                <h5 class="mb-0 font-bold text-blue-600">{{ $onProgressProjects }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400">
                                <i class="ni ni-settings text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Selesai</p>
                                <h5 class="mb-0 font-bold text-green-600">{{ $completedProjects }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-400">
                                <i class="ni ni-check-bold text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2: STATISTIK ENTITAS (USER & CLIENT) --}}
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Klien Terdaftar</p>
                                <h5 class="mb-0 font-bold">{{ $totalClients }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-orange-600 to-yellow-400">
                                <i class="ni ni-world text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total User</p>
                                <h5 class="mb-0 font-bold">{{ $totalUsers }}</h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-red-600 to-rose-400">
                                <i class="ni ni-single-02 text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- BAGIAN TABEL (BIARKAN APA ADANYA) --}}
    <div class="flex flex-wrap -mx-3">
        {{-- ... Kode tabel proyek kamu yang lama ... --}}
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6 class="mb-0">Proyek Terbaru</h6>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            {{-- ... Isi tabel copy dari kode lamamu ... --}}
                            @include('projects.style') {{-- Panggil style jika perlu --}}
                            {{-- (ATAU BIARKAN KODE TABEL LAMA KAMU DI SINI) --}}
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Proyek</th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Klien</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentProjects as $project)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal font-semibold">{{ $project->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-500">{{ $project->client->name ?? '-' }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        {{-- LOGIKA WARNA MANUAL (HARDCODE STYLE) --}}
                                        {{-- Ini memotong jalur Tailwind/CSS, jadi warnanya dipaksa muncul langsung dari HTML --}}
                                        @php
                                            $style = match($project->status) {
                                                // Abu-abu (Pending)
                                                'Pending'     => 'background: linear-gradient(310deg, #a0aec0 0%, #a8b8d8 100%); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);',
                                                // Biru (In Progress)
                                                'In Progress' => 'background: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%); box-shadow: 0 4px 6px -1px rgba(33, 82, 255, 0.3);',
                                                // Hijau (Completed)
                                                'Completed'   => 'background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%); box-shadow: 0 4px 6px -1px rgba(23, 173, 55, 0.3);',
                                                // Default (Jika status lain)
                                                default       => 'background: #cbd5e0;',
                                            };
                                        @endphp
                                        <span style="{{ $style }}" class="px-3 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            {{ $project->status }}
                                        </span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400">{{ $project->created_at->format('d M Y') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-slate-500">Belum ada data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- Panggil style tombol/status biar konsisten --}}
    @include('projects.style')
@endpush

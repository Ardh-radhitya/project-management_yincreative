@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl p-8" id="reportArea">

                {{-- KOP LAPORAN --}}
                <div class="flex justify-between items-start border-b-2 border-slate-100 pb-6 mb-6">
                    <div class="text-left">
                        <h3 class="font-bold text-slate-800 mb-0">LAPORAN PENYELESAIAN PROYEK</h3>
                        <p class="text-sm text-slate-500 uppercase tracking-wider font-semibold">Y.in Creative Agency - Project Management System</p>
                    </div>
                    <div class="text-right">
                        <button onclick="window.print()" class="px-4 py-2 bg-slate-800 text-white rounded-lg text-xs font-bold uppercase no-print">
                            <i class="fas fa-print mr-2"></i> Cetak Laporan
                        </button>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-8 text-left">
                    <div class="w-full md:w-1/2 px-3">
                        <h6 class="text-xs font-bold uppercase text-slate-400 mb-3">Informasi Proyek</h6>
                        <table class="w-full text-sm">
                            <tr><td class="py-1 text-slate-500 w-1/3">Nama Proyek</td><td class="py-1 font-bold text-slate-700">: {{ $project->name }}</td></tr>
                            <tr><td class="py-1 text-slate-500">Klien</td><td class="py-1 font-bold text-slate-700">: {{ $project->client->name ?? '-' }}</td></tr>
                            <tr><td class="py-1 text-slate-500">Kategori</td><td class="py-1 font-bold text-slate-700">: {{ $project->category->name ?? 'Umum' }}</td></tr>
                        </table>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <h6 class="text-xs font-bold uppercase text-slate-400 mb-3">Statistik Pengerjaan</h6>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <div class="flex justify-between mb-2">
                                <span class="text-xs font-bold text-slate-600">Total Progress</span>
                                <span class="text-xs font-bold text-slate-800">{{ $progressPercentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-tl from-blue-600 to-cyan-400 h-2 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-2 italic font-semibold">* {{ $completedTasks }} dari {{ $totalTasks }} tugas selesai.</p>
                        </div>
                    </div>
                </div>

                {{-- RINCIAN FILE HASIL (DELIVERABLES) --}}
                <div class="mb-8 text-left">
                    <h6 class="text-xs font-bold uppercase text-slate-400 mb-3">Daftar Penyerahan Hasil (Deliverables)</h6>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-xxs uppercase font-bold text-slate-500 border-b">
                                <th class="p-3 text-left">No</th>
                                <th class="p-3 text-left">Nama File / Aset</th>
                                <th class="p-3 text-left">Keterangan</th>
                                <th class="p-3 text-center">Tanggal Kirim</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($project->deliveries as $index => $file)
                            <tr class="border-b border-slate-50">
                                <td class="p-3 text-slate-600">{{ $index + 1 }}</td>
                                <td class="p-3 font-bold text-slate-700">{{ $file->file_name }}</td>
                                <td class="p-3 text-slate-600 text-xs">{{ $file->description ?? '-' }}</td>
                                <td class="p-3 text-center text-slate-500 text-xs">{{ $file->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="p-4 text-center italic text-slate-400">Belum ada file yang diserahkan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- TTD (DUMMY UNTUK KESAN FORMAL) --}}
                <div class="mt-12 flex justify-end text-left">
                    <div class="text-center w-1/3 border-t-2 border-slate-100 pt-4">
                        <p class="text-xs text-slate-500 mb-12 uppercase font-bold tracking-widest">Penanggung Jawab Proyek</p>
                        <p class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 uppercase">Administrator System</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none !important; }
        body { background: white !important; }
        .shadow-soft-xl { shadow: none !important; }
        .main-content { margin: 0 !important; padding: 0 !important; }
    }
</style>
@endsection

@extends('layout.main')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl p-6">

                {{-- HEADER HALAMAN --}}
                <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                    <div class="text-left">
                        <h5 class="font-bold mb-0">Delivery & Result: {{ $project->name }}</h5>
                        <p class="text-xs text-slate-400">Halaman penyerahan hasil pengerjaan proyek kepada klien.</p>
                    </div>

                    {{-- Ganti tombol yang lama dengan ini --}}
                    @if(strtoupper(auth()->user()->role->name) == 'ADMIN')
                    <a href="{{ route('projects.delivery.report', $project->id) }}" target="_blank"
                    class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-600 border-0 rounded-lg shadow-md text-xs hover:bg-blue-700 active:opacity-85">
                        <i class="fa fa-file-pdf mr-2"></i> Download PDF Report
                    </a>
                    @endif
                </div>

                {{-- FORM UPLOAD (KHUSUS ADMIN & TEAM) --}}
                @if(auth()->user()->role->name != 'Client')
                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-300 text-left">
                    <h6 class="text-sm font-bold mb-3 text-slate-700">Upload Hasil Akhir / Aset Proyek</h6>
                    <form action="{{ route('projects.delivery.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-wrap items-end gap-4">
                        @csrf
                        <div class="flex-1 min-w-[250px]">
                            <label class="text-xxs font-bold uppercase text-slate-400 ml-1">Pilih File (PDF, ZIP, Image - Max 20MB)</label>
                            <input type="file" name="file_hasil" class="block w-full text-xs border border-gray-200 rounded-lg p-2 bg-white focus:ring-blue-500">
                        </div>
                        <div class="flex-1 min-w-[250px]">
                            <label class="text-xxs font-bold uppercase text-slate-400 ml-1">Keterangan / Deskripsi File</label>
                            <input type="text" name="description" placeholder="Misal: Desain Logo Final v1.0" class="block w-full text-xs border border-gray-200 rounded-lg p-2 bg-white focus:ring-blue-500">
                        </div>
                        <button type="submit" class="px-8 py-2.5 bg-slate-700 text-white rounded-lg text-xs font-bold uppercase hover:scale-105 transition-all">
                            Kirim ke Klien
                        </button>
                    </form>
                </div>
                @endif

                {{-- TABEL DAFTAR FILE HASIL --}}
                <div class="overflow-x-auto text-left">
                    <h6 class="text-sm font-bold mb-4 text-slate-700">Daftar Hasil Pengerjaan (Deliverables)</h6>
                    <table class="w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead>
                            <tr class="text-xxs uppercase text-slate-400 font-bold border-b border-gray-200">
                                <th class="pb-3 px-2">Nama File & Keterangan</th>
                                <th class="pb-3 px-2 text-center">Diunggah Oleh</th>
                                <th class="pb-3 px-2 text-center">Tanggal</th>
                                <th class="pb-3 px-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->deliveries as $delivery)
                            <tr class="border-b border-gray-100">
                                <td class="py-4 px-2">
                                    <div class="flex flex-col">
                                        <h6 class="mb-0 text-sm font-bold text-slate-800">{{ $delivery->file_name }}</h6>
                                        <p class="mb-0 text-xs text-slate-400">{{ $delivery->description ?? 'Tidak ada keterangan' }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-2 text-center">
                                    <span class="text-xs font-semibold">{{ $delivery->user->name }}</span>
                                    <p class="text-xxs text-slate-400 uppercase">{{ $delivery->user->role->name }}</p>
                                </td>
                                <td class="py-4 px-2 text-center">
                                    <span class="text-xs text-slate-500">{{ $delivery->created_at->format('d M Y') }}</span>
                                    <p class="text-xxs text-slate-400">{{ $delivery->created_at->format('H:i') }} WIB</p>
                                </td>
                                <td class="py-4 px-2 text-right">
                                    <a href="{{ asset('storage/' . $delivery->file_path) }}" target="_blank" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro border-blue-500 text-xs ease-soft-in hover:scale-102 active:shadow-soft-xs tracking-tight-soft text-blue-500">
                                        <i class="fa fa-download mr-1"></i> Download
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center">
                                    <i class="ni ni-folder-17 text-slate-300 text-4xl mb-2"></i>
                                    <p class="text-sm italic text-slate-400">Belum ada file hasil pengerjaan yang diserahkan.</p>
                                </td>
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

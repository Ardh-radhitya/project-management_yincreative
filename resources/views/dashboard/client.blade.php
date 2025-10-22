    @extends('layout.main')

    {{-- Mengirim judul halaman ke layout utama --}}
    @section('page-title', 'Dashboard Klien')

    @section('content')
        @if (session('success'))
            <div class="alert-success mb-6" role="alert">
                <span class="font-bold">Sukses!</span> {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Ajukan Proyek --}}
        <a href="{{ route('client.projects.create') }}" class="btn-primary mb-6">Ajukan Proyek Baru</a>

        {{-- Kartu Daftar Proyek (Contoh, belum ada data) --}}
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0">Proyek Anda</h6>
            </div>
            <div class="flex-auto p-6">
                <p class="text-center text-gray-500">Anda belum memiliki proyek.</p>
                {{-- Nanti kita akan looping data proyek klien di sini --}}
            </div>
        </div>

        {{-- Hapus bagian Upload References jika tidak relevan lagi --}}
        {{--
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0">Upload References</h6>
            </div>
            <div class="flex-auto p-6">
                Contoh bagian upload
            </div>
        </div>
        --}}
    @endsection

    @push('styles')
        @include('projects.style')
    @endpush

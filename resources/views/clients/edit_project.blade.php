    @extends('layout.main')

    @section('page-title', 'Edit Proyek Saya')

    @section('content')
    {{-- WRAPPER UTAMA: Style Manual Box Putih --}}
    <div style="background-color: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 24px; margin-bottom: 24px;">

        {{-- HEADER --}}
        <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
            <h6 style="font-weight: 700; color: #344767; margin: 0;">Edit Proyek: <span style="color: #825ee4;">{{ $project->name }}</span></h6>
        </div>

        {{-- ACTION ROUTE: Pastikan route ini ada di web.php --}}
        {{-- Biasanya: Route::put('/client/projects/{project}', [ClientController::class, 'updateProject'])->name('client.projects.update'); --}}
        <form action="{{ route('client.projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- 1. NAMA PROYEK --}}
            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                    Nama Proyek
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                    style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; background-color: #fff; border: 1px solid #d2d6da; border-radius: 8px; outline: none;">
            </div>

            {{-- 2. GRID MANUAL (Flexbox) - KLIEN & KATEGORI --}}
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">

                {{-- Klien (Langsung ambil dari Auth User karena $clients tidak dikirim controller) --}}
                <div style="flex: 1; min-width: 250px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                        Klien (Saya)
                    </label>
                    {{-- Input Mati (Disabled) --}}
                    <input type="text" value="{{ Auth::user()->name }}" disabled
                        style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; background-color: #e9ecef; border: 1px solid #d2d6da; border-radius: 8px; outline: none; cursor: not-allowed;">

                    {{-- Kirim ID Client Hidden (Biar controller gak error validasi) --}}
                    {{-- Kita ambil ID dari relasi project yg sedang diedit --}}
                    <input type="hidden" name="client_id" value="{{ $project->client_id }}">
                </div>

                {{-- Kategori (Controller ngirim $categories, jadi ini aman) --}}
                <div style="flex: 1; min-width: 250px;">
                    <label for="category_id" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                        Kategori
                    </label>
                    <select name="category_id" id="category_id" style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; border: 1px solid #d2d6da; border-radius: 8px; outline: none;">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 3. GRID MANUAL (Flexbox) - TANGGAL --}}
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1; min-width: 250px;">
                    <label for="start_date" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                        Tanggal Mulai
                    </label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}"
                        style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; border: 1px solid #d2d6da; border-radius: 8px; outline: none;">
                </div>
                <div style="flex: 1; min-width: 250px;">
                    <label for="end_date" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                        Tanggal Selesai
                    </label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}"
                        style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; border: 1px solid #d2d6da; border-radius: 8px; outline: none;">
                </div>
            </div>

            {{-- 4. STATUS (Disabled/Read Only karena Client gak boleh ubah status seenaknya) --}}
            <div style="margin-bottom: 20px;">
                <label for="status" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                    Status
                </label>
                <select name="status" id="status" disabled style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; background-color: #e9ecef; border: 1px solid #d2d6da; border-radius: 8px; outline: none; cursor: not-allowed;">
                    <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                {{-- Kirim hidden input status biar gak error validasi --}}
                <input type="hidden" name="status" value="{{ $project->status }}">
            </div>

            {{-- 5. DESKRIPSI --}}
            <div style="margin-bottom: 30px;">
                <label for="description" style="display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: #67748e; margin-bottom: 8px;">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="4"
                        style="display: block; width: 100%; padding: 10px 12px; font-size: 14px; color: #495057; border: 1px solid #d2d6da; border-radius: 8px; outline: none;">{{ old('description', $project->description) }}</textarea>
            </div>

            {{-- 6. TOMBOL ACTION --}}
            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px;">

                {{-- Tombol Batal --}}
                <a href="{{ route('dashboard.client') }}"
                style="padding: 12px 24px; background-color: #a0aec0; color: white; border-radius: 8px; font-weight: 700; font-size: 12px; text-transform: uppercase; text-decoration: none; border: none; cursor: pointer; display: inline-block;">
                    Batal
                </a>

                {{-- Tombol Simpan --}}
                <button type="submit"
                        style="padding: 12px 24px; background-image: linear-gradient(310deg, #7928CA 0%, #FF0080 100%); color: white; border-radius: 8px; font-weight: 700; font-size: 12px; text-transform: uppercase; border: none; cursor: pointer;">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
    @endsection

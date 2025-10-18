@extends('layout.main')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6>Edit Klien</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-6">
                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Nama Klien</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $client->name) }}" placeholder="Nama Klien" class="form-input @error('name') border-red-500 @enderror" />
                            @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" placeholder="Email Klien" class="form-input @error('email') border-red-500 @enderror" />
                            @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Telepon (Opsional)</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $client->phone) }}" placeholder="Nomor Telepon" class="form-input @error('phone') border-red-500 @enderror" />
                            @error('phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="company" class="inline-block mb-2 ml-1 font-bold text-size-xs text-slate-700">Perusahaan (Opsional)</label>
                            <input type="text" name="company" id="company" value="{{ old('company', $client->company) }}" placeholder="Nama Perusahaan" class="form-input @error('company') border-red-500 @enderror" />
                            @error('company')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('clients.index') }}" class="btn-secondary">Batal</a>
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
@include('projects.style')
@endpush

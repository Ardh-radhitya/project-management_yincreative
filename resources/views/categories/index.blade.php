@extends('layout.main')

@section('content')


<div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="flex justify-between items-center">
            <h6 class="mb-0">Tabel Kategori Proyek</h6>
            <a href="{{ route('projects.create') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-blue-500 border-0 rounded-lg cursor-pointer shadow-md hover:shadow-lg hover:bg-blue-600 active:opacity-85">
            + Tambah Kategori
        </a>
        </div>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                    <tr>
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-size-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kategori</th>
                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                                <h6 class="mb-0 text-size-sm leading-normal">{{ $category->name }}</h6>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                            {{-- Edit Category --}}
                            <a href="{{ route('categories.edit', $category->id) }}"
                            class="inline-block text-center align-middle transition-all cursor-pointer leading-pro ease-soft-in tracking-tight-rem shadow-soft-xs hover:scale-102 hover:shadow-soft-md active:opacity-85"
                            style="background-color: #344767; color: white; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; text-decoration: none; margin-right: 4px;">
                                Edit
                            </a>

                            {{-- Delete Category --}}
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus kategori ini? Project yang pakai kategori ini mungkin akan terdampak.');">
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
                        <td colspan="2" class="p-4 text-center text-slate-500">Belum ada data kategori.</td>
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

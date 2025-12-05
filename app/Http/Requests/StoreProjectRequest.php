<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProjectRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna berwenang membuat request ini.
     */
    public function authorize(): bool
    {
        // Pastikan user sudah login (Middleware CheckRole sudah menangani role, jadi true aman)
        return Auth::check();
    }

    /**
     * Aturan validasi.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    /**
     * Kustomisasi pesan error (Opsional, agar lebih ramah pengguna).
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Silakan pilih kategori proyek.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ];
    }
}

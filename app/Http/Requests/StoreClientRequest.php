<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya Admin yang boleh akses
        return Auth::check() && Auth::user()->role->name === 'Admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            // 'photo_profile' => 'nullable|image|max:2048', // Jika nanti ada upload foto
        ];
    }
}

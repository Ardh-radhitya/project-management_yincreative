<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role->name === 'Admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            // Email harus unique, KECUALI untuk user yang sedang diedit ini
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8', // Password nullable kalau gak mau diganti
        ];
    }
}

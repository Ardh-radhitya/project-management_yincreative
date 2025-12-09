<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role->name === 'Admin';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            // Email unik, kecuali untuk klien ini sendiri
            'email' => ['required', 'email', Rule::unique('clients')->ignore($this->client)],
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ];
    }
}

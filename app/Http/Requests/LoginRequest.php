<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function messages():array{
        return [
            'email.required' => 'Mohon Masukkan Email Terlebih Dahulu!',
            'password.required' => 'Mohon Masukkan Password Terlebih Dahulu!'
        ];
    }
}

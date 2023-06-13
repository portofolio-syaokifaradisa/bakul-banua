<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UmkmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('web')->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'since' => 'required|digits:4|numeric',
            'nib' => 'required|unique:umkms,nib',
            'address' => 'required',
            'owner' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|unique:umkms,email',
            'password' => 'required'
        ];
    }

    public function messages(): array{
        return [
            'name.required' => 'Mohon Masukkan Nama UMKM Terlebih Dahulu!',
            'since.required' => 'Mohon Masukkan Tahun Berdiri Terlebih Dahulu!',
            'since.digits' => 'Mohon Masukkan Tahun Berdiri Sebanyak 4 Digit!',
            'since.numeric' => 'Mohon Masukkan Tahun Berdiri Dengan Format Numerik!',
            'nib.required' => 'Mohon Masukkan NIB Terlebih Dahulu!',
            'nib.unique' => 'NIB Sudah Pernah Terdaftar Sebelumnya!',
            'address.required' => 'Mohon Masukkan Alamat UMKM Terlebih Dahulu!',
            'owner.required' => 'Mohon Masukkan Nama Lengkap Pemilik UMKM!',
            'phone.required' => 'Mohon Masukkan Nomor Telepon Terlebih Dahulu!',
            'phone.numeric' => 'Mohon Masukkan Nomor Telepon Dengan Format Numerik!',
            'email.required' => 'Mohon Masukkan Email Terlebih Dahulu!',
            'email.unique' => 'Email Sudah Pernah Terdaftar Sebelumnya!',
            'password.required' => 'Mohon Masukkan Password Terlebih Dahulu!'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'nib' => 'required|unique:umkms,nib',
            'since' => 'required|numeric|digits:4',
            'address' => 'required',
            'owner' => 'required',
            'phone' => 'required|numeric|unique:umkms,phone',
            'email'=> 'required|email|unique:umkms,email',
            'password' => 'required'
        ];
    }

    public function messages():array
    {
        return [
            'name.required' => 'Mohon Masukkan Nama UMKM Terlebih Dahulu!',
            'nib.required' => 'Mohon Masukkan Nomor Induk Berusaha Terlebih Dahulu!',
            'nib.unique' => 'NIB Sudah Pernah Terdaftar Sebelumnya!',
            'since.required' => 'Mohon Masukkan Tahun Berdiri UMKM!',
            'since.numeric' => 'Mohon Masukkan Tahun Berdiri Berupa Format Angka!',
            'since.digits' => 'Mohon Masukkan Tahun Berdiri Sebanyak 4 Digit!',
            'address.required' => 'Mohon Masukkan Alamat UMKM Terlebih Dahulu!',
            'owner.required' => 'Mohon Masukkan Pemilik UMKM Terlebih Dahulu!',
            'phone.required' => 'Mohon Masukkan Nomor Telepon Pemilik UMKM Terlebih Dahulu!',
            'phone.numeric' => 'Mohon Masukkan Nomor Telepon Dengan Format Angka!',
            'phone.unique' => 'Nomor Telepon Sudah Pernah Terdaftar Sebelumnya!',
            'email.required' => 'Mohon Masukkan Email Terlebih Dahulu!',
            'email.email' => 'Mohon Masukkan Format Email Dengan Benar!',
            'email.unique' => 'Email Sudah Pernah Terdaftar Sebelumnya!',
            'password.required' => 'Mohon Masukkan Password Terlebih Dahulu!'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'picture' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ];

        if(Auth::guard('web')->check()){
            $rules['umkm_id'] = 'required|exists:umkms,id';
        }
        return $rules;
    }

    public function messages(): array{
        $messages = [
            'picture.required' => 'Mohon Upload Foto Produk Terlebih Dahulu!',
            'name.required' => 'Mohon Masukkan Form Nama Produk Terlebih Dahulu!',
            'price.required' => 'Mohon Masukkan Harga Produk Terlebih Dahulu!',
            'description.required' => 'Mohon Masukkan Deskripsi Produk Terlebih Dahulu!'
        ];

        if(Auth::guard('web')->check()){
            $messages['umkm_id.required'] = "Mohon Pilih UMKM Pemilik Produk Terlebih Dahulu!";
            $messages['umkm_id.exists'] = "UMKM Belum Terdaftar!";
        }

        return $messages;
    }
}

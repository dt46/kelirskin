<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'nama' => ['required'],
            'no_hp' => ['required'],
            'provinsi' => ['required'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'alamat_detail' => ['required'],
            // 'lokasi_geojson' => ['required'],
            'foto_ktp' => ['required'],
        ];
    }
}
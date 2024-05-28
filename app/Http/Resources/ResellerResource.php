<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email ?? $this->user->email,
            'no_hp' => $this->no_hp,
            'alamat_detail' => $this->alamat_detail,
            'foto_ktp' => $this->foto_ktp,
            'nama_file_original' => $this->nama_file_original,
            'status' => $this->status
        ];    
    }
}

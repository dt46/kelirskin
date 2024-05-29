<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'id_reseller' => $this->id_reseller,
            'metode_pembayaran' => $this->metode_pembayaran,
            'biaya_layananAplikasi' => $this->biaya_layananAplikasi,
            'ongkos_kirim' => $this->ongkos_kirim,
            'total_harga' => $this->total_harga,
            'nama_file_original' => $this->nama_file_original,
            'bukti_pembayaran' => $this->bukti_pembayaran,
            'no_resi' => $this->no_resi,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
        ];
    }
}
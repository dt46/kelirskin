<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reseller extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "user_id",
        "nama",
        "no_hp",
        'provinsi',
        'kota',
        'kecamatan',
        'alamat_detail',
        'foto_ktp',
        'nama_file_original'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

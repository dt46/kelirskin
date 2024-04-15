<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reseller extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "no_hp",
        'provinsi',
        'kota',
        'kecamatan',
        'alamat_detail',
        'foto_ktp'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

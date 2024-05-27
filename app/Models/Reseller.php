<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reseller extends Model
{
    use HasFactory, HasUuids;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

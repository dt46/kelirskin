<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_admin',
        'fotoProduk',
        'nama_foto_original',
        'namaProduk',
        'hargaProduk',
        'stokProduk',
        'beratProduk',
        'deskripsiProduk',
        'kategoriProduk',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}

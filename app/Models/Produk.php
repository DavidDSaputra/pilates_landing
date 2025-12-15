<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriProduk;
use App\Traits\LogsActivity;
use App\Models\GambarProduk;

class Produk extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'slug',
        'deskripsi_lengkap',
        'rekomendasi',
        'gambar_utama',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'canonical_url',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function gambar()
    {
        return $this->hasMany(GambarProduk::class, 'produk_id');
    }
}

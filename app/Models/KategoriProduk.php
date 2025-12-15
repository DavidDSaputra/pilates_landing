<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class KategoriProduk extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'kategori_produk';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'gambar',
        'urutan',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}

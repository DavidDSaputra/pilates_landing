<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    use HasFactory;

    protected $table = 'gambar_produk';

    protected $fillable = [
        'produk_id',
        'nama_file',
        'alt_text',
        'title_text',
        'urutan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    public function getUrlAttribute()
    {
        return asset('storage/produk/' . $this->nama_file);
    }
}
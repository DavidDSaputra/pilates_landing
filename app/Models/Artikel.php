<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\LogsActivity;

class Artikel extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tags',
        'penulis_id',
        'views',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }



    public function scopePopular($query, $limit = 5)
    {
        return $query->orderBy('views', 'desc')->take($limit);
    }

    public function getExcerptAttribute($length = 150)
    {
        $content = strip_tags($this->konten);
        if (strlen($content) > $length) {
            return substr($content, 0, $length) . '...';
        }
        return $content;
    }
}
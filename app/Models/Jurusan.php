<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $fillable = [
        'nama_jurusan',
        'fasilitas_jurusan',
        'deskripsi',
        'gambar',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getDeskripsiSingkatAttribute()
    {
        $text = preg_replace('/<[^>]*>/', '', $this->deskripsi);

        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

        $text = preg_replace('/\s+/', ' ', $text);

        return Str::limit(trim($text), 120);
    }
}

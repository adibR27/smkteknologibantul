<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar_utama',
        'kategori',
        'penulis_id',
        'views',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penulis()
    {
        return $this->belongsTo(Admin::class, 'penulis_id');
    }
}

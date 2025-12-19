<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'kategori',
        'tanggal_foto',
        'status',
    ];

    protected $casts = [
        'tanggal_foto' => 'date',
        'status' => 'boolean',
    ];
}

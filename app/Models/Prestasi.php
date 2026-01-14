<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'judul_prestasi',
        'deskripsi',
        'gambar',
        'tingkat',
        'peraih',
        'tanggal_perolehan',
        'penyelenggara',
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
    ];

    // Accessor untuk format tanggal Indonesia
    public function getTanggalPerolehanFormattedAttribute()
    {
        return $this->tanggal_perolehan ? $this->tanggal_perolehan->format('d F Y') : '-';
    }

    // Accessor untuk gambar
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }
}

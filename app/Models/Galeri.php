<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'caption',
        'gambar',
        'tanggal_kegiatan',
        'uploaded_by',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    /**
     * Relasi ke Admin 
     */
    public function uploader()
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }
}

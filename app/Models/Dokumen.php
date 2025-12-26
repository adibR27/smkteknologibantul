<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
        'judul',
        'deskripsi',
        'nama_file',
        'path_file',
        'ukuran_file',
        'kategori',
        'uploaded_by',
    ];

    protected $casts = [
        'ukuran_file' => 'integer',
    ];

    /**
     * Relasi ke Admin (uploader)
     */
    public function uploader()
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'kategori',
        'download_count',
        'status',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'download_count' => 'integer',
        'status' => 'boolean',
    ];

    public function incrementDownload()
    {
        $this->increment('download_count');
    }
}

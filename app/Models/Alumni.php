<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'foto',
        'jurusan_id',
        'tahun_lulus',
        'pekerjaan_sekarang',
        'pesan_alumni',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}

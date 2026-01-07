<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nama_lengkap',
        'foto',
        'email',
        'jurusan_id',
        'jabatan',
        'mata_pelajaran',
        'pendidikan_terakhir',
    ];

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}

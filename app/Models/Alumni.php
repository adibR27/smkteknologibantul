<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'foto',
        'tahun_lulus',
        'jurusan_id',
        'pekerjaan',
        'perusahaan',
        'testimoni',
        'status',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
        'status' => 'boolean',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}

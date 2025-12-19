<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'foto',
        'mata_pelajaran',
        'jabatan',
        'pendidikan',
        'email',
        'telepon',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

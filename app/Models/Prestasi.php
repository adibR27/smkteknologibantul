<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasi';

    protected $fillable = [
        'nama_prestasi',
        'tingkat',
        'tahun',
        'penyelenggara',
        'deskripsi',
        'foto',
        'status',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'status' => 'boolean',
    ];
}

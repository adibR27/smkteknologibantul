<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepalaSekolah extends Model
{
    use HasFactory;

    protected $table = 'kepala_sekolah';

    protected $fillable = [
        'nama',
        'foto',
        'sambutan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

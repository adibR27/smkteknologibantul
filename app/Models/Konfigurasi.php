<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfigurasi extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi';

    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'no_telepon',
        'email',
        'logo',
        'favicon',
        'deskripsi',
        'meta_keywords',
    ];
}
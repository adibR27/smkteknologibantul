<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'tanggal_kirim'
    ];

    protected $dates = [
        'tanggal_kirim',
        'created_at',
        'updated_at'
    ];

    // Mutator untuk set tanggal_kirim otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengaduan) {
            if (!$pengaduan->tanggal_kirim) {
                $pengaduan->tanggal_kirim = now();
            }
        });
    }

    // Accessor untuk format tanggal
    public function getTanggalKirimFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_kirim)->format('d F Y, H:i');
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_kirim', today());
    }

    public function scopeBulanIni($query)
    {
        return $query->whereMonth('tanggal_kirim', now()->month)
            ->whereYear('tanggal_kirim', now()->year);
    }
}

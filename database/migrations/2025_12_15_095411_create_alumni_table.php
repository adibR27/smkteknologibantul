<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('foto', 255)->nullable();
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusan')->onDelete('set null');
            $table->year('tahun_lulus');
            $table->string('pekerjaan_sekarang', 255)->nullable();
            $table->timestamps();

            $table->index('tahun_lulus', 'idx_alumni_tahun');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};

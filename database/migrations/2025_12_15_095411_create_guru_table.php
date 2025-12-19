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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('foto', 255)->nullable();
            $table->string('email', 100)->nullable();
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusan')->onDelete('set null');
            $table->string('jabatan', 100)->nullable();
            $table->string('mata_pelajaran', 100)->nullable();
            $table->string('pendidikan_terakhir', 100)->nullable();
            $table->timestamps();

            $table->index('jurusan_id', 'idx_guru_jurusan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};

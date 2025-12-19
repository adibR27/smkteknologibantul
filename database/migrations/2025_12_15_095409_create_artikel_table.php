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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->text('konten');
            $table->string('gambar_utama', 255)->nullable();
            $table->enum('kategori', ['berita', 'pengumuman', 'kegiatan', 'lainnya'])->default('berita');
            $table->foreignId('penulis_id')->nullable()->constrained('admin')->onDelete('set null');
            $table->integer('views')->default(0);
            $table->dateTime('tanggal_publish')->nullable();
            $table->timestamps();

            $table->index('kategori', 'idx_artikel_kategori');
            $table->index('tanggal_publish', 'idx_artikel_tanggal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};

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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->string('nama_file', 255);
            $table->string('path_file', 255);
            $table->integer('ukuran_file')->nullable();
            $table->enum('kategori', ['kurikulum', 'panduan', 'formulir', 'lainnya'])->default('lainnya');
            $table->foreignId('uploaded_by')->nullable()->constrained('admin')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};

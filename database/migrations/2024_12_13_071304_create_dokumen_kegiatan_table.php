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
        Schema::create('dokumen_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_periode'); 
            $table->string('nama_kegiatan'); 
            $table->text('proposal')->nullable();
            $table->text('lpj')->nullable();
            $table->text('lpjk')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('keterangan', ['Sedang Proses', 'Selesai', 'Ditunda', 'Dibatalkan'])->default('Sedang Proses');
            $table->timestamps();

            // Menambahkan foreign key untuk relasi ke tabel users dan periodes
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_kegiatan');
    }
};

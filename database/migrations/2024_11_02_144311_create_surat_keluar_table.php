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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users'); 
            $table->foreignId('id_periode')->constrained('periodes');
            $table->string('nomor_surat_keluar')->unique(); 
            $table->string('tertuju'); 
            $table->string('keterangan'); 
            $table->date('tanggal_surat'); 
            $table->date('tanggal_terkirim'); 
            $table->string('file'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};

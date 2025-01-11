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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users'); // Foreign Key to users table
            $table->string('gambar'); 
            $table->string('nama_barang'); 
            $table->integer('jumlah'); 
            $table->string('satuan');
            $table->string('sumber_pengadaan'); 
            $table->text('keterangan')->nullable(); 
            $table->enum('kondisi', ['baik', 'rusak', 'perbaikan', 'hilang'])->default('baik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};

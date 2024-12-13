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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggota'); // Foreign key to anggota table
            $table->string('nama_prestasi');
            $table->enum('tingkat', ['lokal', 'nasional', 'internasional']);
            $table->year('tahun_prestasi');
            $table->text('keterangan')->nullable();
            $table->string('file')->nullable(); // Path to the file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};

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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('id_user')->constrained('users'); // Foreign Key to users table
            $table->foreignId('id_periode')->constrained('periodes'); // Foreign Key to periode table
            // $table->string('id_periode'); // Foreign Key to periode table
            // $table->string('id_user'); // Foreign Key to periode table
            $table->string('nomor_surat_masuk')->unique(); // Unique constraint for surat number
            $table->string('pengirim'); // Sender's name
            $table->date('tanggal_surat'); // Date of the letter
            $table->date('tanggal_terima'); // Date the letter was received
            $table->string('penerima'); // Subject or description of the letter
            $table->string('file'); // File path of the surat
            $table->text('keterangan')->nullable(); // Optional additional information
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};

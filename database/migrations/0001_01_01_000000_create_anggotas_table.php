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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periode'); // Foreign Key
            $table->string('nim');
            $table->string('nama');
            $table->string('no_hp', 15);
            $table->enum('status_keanggotaan', ['aktif', 'lulus', 'drop out'])->default('aktif');
            $table->string('kelas', 50);
            $table->timestamps();

            // Define Foreign Key Constraint
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};

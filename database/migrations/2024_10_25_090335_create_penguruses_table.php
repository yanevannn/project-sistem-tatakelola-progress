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
        Schema::create('penguruses', function (Blueprint $table) {
            $table->string('nim')->primary(); // Primary key (NIM)
            $table->string('nama');
            $table->string('email')->unique(); // Email dengan constraint unik
            $table->string('jabatan');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat')->nullable();
            $table->string('no_hp');
            $table->enum('status', ['Aktif', 'Non-Aktif']);
            $table->string('password');
            $table->enum('role', ['Pengurus Inti', 'Pengurus']); // Role dengan pilihan 'Pengurus Inti' dan 'Pengurus'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penguruses');

    }
};

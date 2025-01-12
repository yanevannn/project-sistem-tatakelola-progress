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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_periode')->constrained('periode')->cascadeOnDelete(); // Foreign key ke tabel periodes
            $table->foreignId('id_anggota')->constrained('anggota')->cascadeOnDelete(); // Foreign key ke tabel anggota
            $table->enum('role', ['Ketua','Wakil Ketua', 'Bendahara', 'Sekretaris', 'Divisi I', 'Divisi II', 'Divisi III']); // Role
            $table->string('email'); // Email
            $table->string('password'); // Kata sandi
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        
            // Membuat constraint unik berdasarkan kombinasi id_periode dan nim/email
            $table->unique(['id_periode', 'email'], 'unique_email_periode');
            $table->unique(['id_periode', 'id_anggota'], 'unique_anggota_periode'); // Unik untuk id_anggota per periode
        });
        

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        // Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

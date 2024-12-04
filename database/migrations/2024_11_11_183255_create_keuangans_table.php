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
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // Foreign key to users table
            $table->unsignedBigInteger('id_periode'); // Foreign key to periodes table
            $table->date('tanggal'); // Date of transaction
            $table->text('keterangan'); // Description
            $table->decimal('pemasukan', 15, 2)->default(0); // Income, with precision and scale
            $table->decimal('pengeluaran', 15, 2)->default(0); // Expenditure, with precision and scale
            $table->timestamps(); // Created_at and updated_at

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_periode')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan');
    }
};

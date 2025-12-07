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
            $table->id();
            $table->string('username_nip', 18)->unique();
            $table->string('nama', 50);
            $table->string('no_telp', 18);
            // Relasi ke tabel jabatans
            $table->foreignId('id_jabatan')->nullable()->constrained('jabatan')->onUpdate('cascade')->onDelete('set null');
            // Relasi ke tabel areas
            $table->foreignId('id_area')->nullable()->constrained('area')->onUpdate('cascade')->onDelete('set null');
            $table->string('password');
            $table->enum('tipe_user', ['admin', 'user', 'manager']); // sesuaikan dengan kebutuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

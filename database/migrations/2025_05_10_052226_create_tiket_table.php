<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('id_tautan', 11)->nullable();
            $table->foreignId('id_user')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('id_kategori_masalah')->nullable()->constrained('kategori_masalah')->onUpdate('cascade')->onDelete('set null');
            $table->string('id_tiket', 20);
            $table->dateTime('waktu_tiket')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->string('gambar_tiket');
            $table->enum('status', ['Pending', 'Process', 'Closed'])->default('Pending');
            $table->text('tanggapan')->nullable();
            $table->string('gambar_tanggapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};

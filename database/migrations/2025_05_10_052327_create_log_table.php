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
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tiket')->nullable()->constrained('tiket')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('id_user')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->dateTime('waktu')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('detail', 50);
            $table->enum('status', ['Pending','Process', 'Closed'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log');
    }
};

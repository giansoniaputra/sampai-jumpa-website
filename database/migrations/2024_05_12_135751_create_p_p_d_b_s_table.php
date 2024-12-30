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
        Schema::create('p_p_d_b_s', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('kegiatan');
            $table->string('tanggal');
            $table->string('tanggal2');
            $table->integer('is_prestasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_p_d_b_s');
    }
};

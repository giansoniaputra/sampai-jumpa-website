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
        Schema::create('jenis_mapels', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('jenis_mapel');
            $table->string('jumlah_jam')->nullable();
            $table->string('jumlah_jam_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_mapels');
    }
};

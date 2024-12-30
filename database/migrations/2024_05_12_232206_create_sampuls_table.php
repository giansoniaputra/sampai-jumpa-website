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
        Schema::create('sampuls', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('home')->nullable();
            $table->string('profil')->nullable();
            $table->string('guru')->nullable();
            $table->string('kurikulum')->nullable();
            $table->string('siswa')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('ppdb')->nullable();
            $table->string('berita')->nullable();
            $table->string('sarana')->nullable();
            $table->string('humas')->nullable();
            $table->string('layanan')->nullable();
            $table->string('gallery')->nullable();
            $table->string('link_ppdb')->nullable();
            $table->string('link_ppdb_bawah')->nullable();
            $table->string('integrity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampuls');
    }
};

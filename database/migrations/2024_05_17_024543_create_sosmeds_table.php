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
        Schema::create('sosmeds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('wa')->nullable();
            $table->string('ig')->nullable();
            $table->string('yt')->nullable();
            $table->string('fb')->nullable();
            $table->string('x')->nullable();
            $table->string('tt')->nullable();
            $table->string('gmail')->nullable();
            $table->string('website')->nullable();
            $table->string('ppdb')->nullable();
            $table->string('ulang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sosmeds');
    }
};

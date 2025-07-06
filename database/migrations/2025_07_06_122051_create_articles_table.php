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
        Schema::create('articles', function (Blueprint $table) {
        $table->bigIncrements('id'); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        $table->string('judul', 255); // VARCHAR(255) NOT NULL
        $table->text('deskripsi'); // TEXT NOT NULL
        $table->text('isi'); // TEXT NOT NULL
        $table->text('gambar')->nullable(); // TEXT NULL
        $table->timestamps(); // created_at & updated_at
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

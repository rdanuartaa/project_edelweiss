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
            $table->bigIncrements('id'); // id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('tag_id')->nullable(); // Tambahkan kolom tag_id
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->text('isi');
            $table->text('gambar')->nullable();
            $table->timestamps();

            // Setelah kolom dibuat, baru tambahkan foreign key
            $table->foreign('tag_id')
                  ->references('id')->on('tags')
                  ->onDelete('set null');
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

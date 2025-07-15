<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('booking_details');
    }

    public function down(): void
    {
        // Optional: jika kamu ingin bisa rollback, bisa buat ulang struktur tabel-nya.
        Schema::create('booking_details', function ($table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('id_card_type')->nullable();
            $table->string('id_card_number')->nullable();
            $table->timestamps();
        });
    }
};

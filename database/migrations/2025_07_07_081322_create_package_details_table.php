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
        Schema::create('package_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
        $table->string('option_name'); // Contoh: 'Short Trip', 'Long Trip'
        $table->integer('price');
        $table->string('duration');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};

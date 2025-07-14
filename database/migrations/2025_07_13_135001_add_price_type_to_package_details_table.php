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
        Schema::table('package_details', function (Blueprint $table) {
            $table->enum('price_type', ['per_orang', 'per_jeep'])->default('per_orang')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_details', function (Blueprint $table) {
            //
        });
    }
};

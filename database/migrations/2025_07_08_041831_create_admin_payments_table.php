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
        Schema::create('admin_payments', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name', 100);
            $table->string('account_number', 100);
            $table->string('account_holder', 100);
            $table->string('qris_image', 255)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_payments');
    }
};

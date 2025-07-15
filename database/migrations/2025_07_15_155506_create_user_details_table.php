<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->enum('id_card_type', ['KTP', 'KTM', 'SIM', 'Paspor','Lainnya']);
            $table->string('id_card_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }

};

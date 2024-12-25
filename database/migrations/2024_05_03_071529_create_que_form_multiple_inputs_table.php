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
        Schema::create('que_form_multiple_inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('label')->nullable();
            $table->text('type')->nullable();
            $table->bigInteger('temp_input_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('que_form_multiple_inputs');
    }
};

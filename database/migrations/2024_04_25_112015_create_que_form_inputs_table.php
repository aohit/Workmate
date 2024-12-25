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
        Schema::create('que_form_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('que_form_id')->nullable();
            $table->unsignedBigInteger('que_form_section_id')->nullable();
            $table->text('label')->nullable();
            $table->text('placeholder')->nullable();
            $table->text('input_name')->nullable();
            $table->unsignedBigInteger('input_type_id')->nullable();
            $table->unsignedBigInteger('rating_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('que_form_inputs');
    }
};

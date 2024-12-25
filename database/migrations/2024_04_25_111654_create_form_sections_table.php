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
        Schema::create('que_form_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('que_form_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps(8); // You can specify the precision if needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('que_form_sections');
    }
};

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
        Schema::create('assess_potentials', function (Blueprint $table) {
            $table->id();
            $table->string('potential', 255)->nullable();
            $table->string('retention', 255)->nullable();
            $table->string('achievable_level', 255)->nullable();
            $table->string('loss_impact', 255)->nullable();
            $table->integer('status')->nullable();
            $table->unsignedBigInteger('performance_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assess_potentials');
    }
};

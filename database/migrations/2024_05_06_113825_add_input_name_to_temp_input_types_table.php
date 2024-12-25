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
        Schema::table('temp_input_types', function (Blueprint $table) {
            $table->text('input_name')->nullable()->default(null)->after('placeholder');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_input_types', function (Blueprint $table) {
            $table->dropColumn('input_name');
        });
    }
};

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
        Schema::table('questionnaires', function (Blueprint $table) {
            $table->integer('que_key')->nullable()->after('appraisal_id');
            $table->longText('que_employ_value')->nullable()->after('que_key');
            $table->longText('que_manager_value')->nullable()->after('que_employ_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questionnaires', function (Blueprint $table) {
            $table->dropColumn('que_key');
            $table->dropColumn('que_employ_value');
            $table->dropColumn('que_manager_value');
        });
    }
};

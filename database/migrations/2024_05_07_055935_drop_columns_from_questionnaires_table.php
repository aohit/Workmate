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
            // Drop the columns
            $table->dropColumn('current_position');
            $table->dropColumn('performance_goals');
            $table->dropColumn('skill_and_knowledge');
            $table->dropColumn('communicates_effectively');
            $table->dropColumn('assigned_responsibilities');
            $table->dropColumn('comments_on_performance');
            $table->dropColumn('future_goals');
            $table->dropColumn('future_dev_goals');
            $table->dropColumn('align_department_goals');
            $table->dropColumn('employ_performance_improvement');
            $table->dropColumn('employ_performance_contribute');
            $table->dropColumn('performance_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('questionnaires', function (Blueprint $table) {
        //     //
        // });
    }
};

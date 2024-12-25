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
        Schema::table('appraisals', function (Blueprint $table) {
            $table->integer('self_popup')->default(0)->after('questionnaire');
            $table->integer('manager_popup')->default(0)->after('self_popup');
            $table->string('self_popup_date', 255)->nullable()->after('manager_popup');
            $table->string('manager_popup_date', 255)->nullable()->after('self_popup_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appraisals', function (Blueprint $table) {
            $table->dropColumn('self_popup');
            $table->dropColumn('manager_popup');
            $table->dropColumn('self_popup_date');
            $table->dropColumn('manager_popup_date');
        });
    }
};

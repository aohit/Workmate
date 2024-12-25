<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->string('deadline')->nullable()->after('description');
            $table->string('category')->nullable()->after('deadline');
            $table->integer('review_cycle')->nullable()->after('category');
            $table->string('tracking')->nullable()->after('review_cycle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn('deadline');
            $table->dropColumn('category');
            $table->dropColumn('review_cycle');
            $table->dropColumn('tracking');
        });
    }
}

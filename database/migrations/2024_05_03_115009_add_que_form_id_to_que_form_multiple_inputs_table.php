<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueFormIdToQueFormMultipleInputsTable extends Migration
{
    public function up()
    {
        Schema::table('que_form_multiple_inputs', function (Blueprint $table) {
            $table->bigInteger('que_form_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('que_form_multiple_inputs', function (Blueprint $table) {
            $table->dropColumn('que_form_id');
        });
    }
}

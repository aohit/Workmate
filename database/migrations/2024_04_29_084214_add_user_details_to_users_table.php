<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('national_id')->nullable()->after('remember_token');
            $table->unsignedBigInteger('phone_number')->nullable()->after('national_id');
            $table->string('gender')->nullable()->after('phone_number');
            $table->string('nationality')->after('gender');
            $table->string('marital_status')->after('nationality');
            $table->unsignedBigInteger('emergency_contact')->nullable()->after('marital_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('national_id');
            $table->dropColumn('phone_number');
            $table->dropColumn('gender');
            $table->dropColumn('nationality');
            $table->dropColumn('marital_status');
            $table->dropColumn('emergency_contact');
        });
    }
}

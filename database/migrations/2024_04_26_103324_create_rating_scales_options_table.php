<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingScalesOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_scale_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rating_scale_id');
            $table->foreign('rating_scale_id')->references('id')->on('rating_scales')->onDelete('cascade');
            $table->text('option_label');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_scale_options');
    }
}

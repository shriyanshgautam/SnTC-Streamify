<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionHoldersStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * Name of the pivot table should be name of related models (not tables) in underscore casing
     */
    public function up()
    {
        Schema::create('position_holder_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_holder_id')->unsigned();
            $table->integer('stream_id')->unsigned();
            $table->timestamps();

            $table->foreign('position_holder_id')->references('id')->on('position_holders');
            $table->foreign('stream_id')->references('id')->on('streams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_holder_stream');
    }
}

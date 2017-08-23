<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodiesStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('body_id')->unsigned();
            $table->integer('stream_id')->unsigned();
            $table->timestamps();

            $table->foreign('body_id')->references('id')->on('bodies');
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
        Schema::dropIfExists('body_stream');
    }
}

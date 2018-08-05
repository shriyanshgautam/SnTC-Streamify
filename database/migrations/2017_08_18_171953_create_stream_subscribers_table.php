<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_stream', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_id')->unsigned();
            $table->integer('stream_id')->unsigned();
            $table->timestamps();

            $table->foreign('app_user_id')->references('id')->on('app_users');
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
        Schema::dropIfExists('app_user_stream');
    }
}

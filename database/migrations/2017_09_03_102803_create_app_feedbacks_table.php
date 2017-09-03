<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('app_user_id')->unsigned();
            $table->timestamps();

            $table->foreign('app_user_id')->references('id')->on('app_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_feedbacks');
    }
}

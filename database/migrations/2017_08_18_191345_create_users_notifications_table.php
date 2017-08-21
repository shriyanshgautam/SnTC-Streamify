<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_notification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('time');
            $table->integer('app_user_id')->unsigned();
            $table->integer('notification_id')->unsigned();
            $table->timestamps();

            $table->foreign('app_user_id')->references('id')->on('app_users');
            $table->foreign('notification_id')->references('id')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_notifications');
    }
}

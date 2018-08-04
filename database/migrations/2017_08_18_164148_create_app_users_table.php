<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('unique_id');
            $table->string('name');
            $table->string('email');
            $table->integer('rollNo')->unsigned()->unique();
            $table->integer('year')->unsigned();
            $table->string('contact');
            $table->string('branch');
            $table->timestamps();

            // TODO add college fk
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->text('city');
          $table->text('address');
          $table->enum('sex',['male','female','unknown']);
          $table->text('rank');
          $table->string('user_image');
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
        Schema::drop('user_information');
    }
}

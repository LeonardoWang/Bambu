<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_table', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('item_id');
          $table->integer('user_id');
          $table->integer('item_owner_id');
          $table->string('user_name');
          $table->text('message');
          $table->text('itemfortrade');
          $table->float('price');
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
        Schema::drop('comment_table');
    }
}

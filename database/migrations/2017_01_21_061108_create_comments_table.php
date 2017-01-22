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
          $table->text('user_id');
          $table->text('message');
          $table->text('itemfortrade');
          $table->text('price');
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

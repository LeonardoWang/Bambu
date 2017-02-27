<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('items', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->integer('user_id');
          $table->string('user_name');
          $table->float('price');
          $table->text('description');
          $table->string('image_file');
          $table->string('image_file_1');
          $table->string('image_file_2');
          $table->string('image_file_3');
          $table->string('image_file_4');
          $table->enum('status', ['selling', 'sold']);
          $table->string('category');
          
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
        Schema::drop('items');
    }
}

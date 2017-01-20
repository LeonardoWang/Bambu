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
          $table->float('price');
          $table->text('description');
          $table->string('image_file');
          $table->enum('status', ['selling', 'sold']);

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

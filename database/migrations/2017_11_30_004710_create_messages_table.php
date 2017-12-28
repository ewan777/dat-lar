<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            $table->string('sender');
            $table->integer('receiver_id')->unsigned();
            $table->string('receiver');
            $table->string('replying_to_title')->nullable();
            $table->text('replying_to_body')->nullable();
            $table->string('title')->nullable();
            $table->text('body');

            $table->dateTime('expires');
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
        Schema::dropIfExists('messages');
    }
}

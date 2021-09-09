<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->bigInteger('_to')->unsigned();
            $table->bigInteger('_from')->unsigned();

            $table->string('title');
            $table->longText('body');
            $table->string('status')->default('unread');

            $table->foreign('_to')->references('id')->on('users');
            $table->foreign('_from')->references('id')->on('users');
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

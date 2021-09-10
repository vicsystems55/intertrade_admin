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

            $table->bigInteger('t_o')->unsigned();
            $table->bigInteger('fr_om')->unsigned();

            $table->string('title');
            $table->longText('body');
            $table->string('status')->default('unread');

            $table->foreign('t_o')->references('id')->on('users');
            $table->foreign('fr_om')->references('id')->on('users');
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

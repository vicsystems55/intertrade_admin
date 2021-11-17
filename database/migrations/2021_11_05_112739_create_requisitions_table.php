<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();

            $table->string('department');

            $table->integer('amount_requested');

            $table->bigInteger('requested_by')->unsigned();

            $table->longText('description');

            $table->bigInteger('approved_by')->unsigned()->nullable();

            $table->string('approver_signature')->nullable();

            $table->integer('amount_approved')->nullable();

            $table->bigInteger('received_by')->unsigned()->nullable();

            $table->string('receiver_signature')->nullable();

            $table->string('status')->default('created');

            
            
            $table->foreign('requested_by')->references('id')->on('users');

            $table->foreign('approved_by')->references('id')->on('users');

            $table->foreign('received_by')->references('id')->on('users');

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
        Schema::dropIfExists('requisitions');
    }
}

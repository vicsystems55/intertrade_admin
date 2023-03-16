<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_by')->unsigned();
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->integer('amount_requested');
            $table->integer('amount_approved')->nullable();
            $table->integer('amount_refunded')->nullable();
            $table->string('date_required')->nullable();
            $table->string('status')->default('pending');
            $table->string('title');
            $table->text('description');
            $table->foreign('request_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
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
        Schema::dropIfExists('cash_requests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->foreignId('manufacturer_id')->nullable();
            $table->foreignId('supplier_id')->nullable();
            $table->foreignId('invoice_id')->nullable();
            $table->string('type')->default('in');

            $table->string('status')->default('active');

            $table->bigInteger('received_by')->unsigned()->nullable();
            $table->foreign('received_by')->references('id')->on('users');

            $table->string('date_received');


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
        Schema::dropIfExists('stocks');
    }
}

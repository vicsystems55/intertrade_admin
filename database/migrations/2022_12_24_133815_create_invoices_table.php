<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_code');
            $table->bigInteger('generated_by')->unsigned();
            $table->foreignId('customer_id')->nullable();
            $table->string('invoice_type')->default('order');
            $table->string('status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('bank_details')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->integer('discount_amount')->nullable();
   
            $table->foreign('generated_by')->references('id')->on('users');

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
        Schema::dropIfExists('invoices');
    }
}

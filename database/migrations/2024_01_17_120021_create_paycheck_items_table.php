<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaycheckItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paycheck_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->double('amount')->default(0);
            $table->double('per_gross')->default(0);
            $table->double('per_basic')->default(0);
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
        Schema::dropIfExists('paycheck_items');
    }
}

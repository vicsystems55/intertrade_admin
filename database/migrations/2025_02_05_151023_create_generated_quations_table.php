<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratedQuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_quations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');

            $table->string('quotation_code'); // Random number between 1000 and 99999
            $table->string('customer_quotation_code'); // Random number between 1000 and 99999
            $table->string('system_capacity'); // e.g., '1.6kW', '3kW', '5kW'
            $table->string('item_description');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->string('category')->nullable(); // e.g., 'Installation Material' or 'Accessory'


            $table->string('status')->default('unpaid');
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
        Schema::dropIfExists('generated_quations');
    }
}

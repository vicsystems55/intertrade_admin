<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('invoice_id')->constrained();
            $table->string('description');
            $table->foreignId('product_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('line_type')->default('product');
            $table->decimal('quantity', 15, 3);
            $table->decimal('amount', 15, 2);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('discount_percent', 8, 3)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);

            
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
        Schema::dropIfExists('invoice_lines');
    }
}

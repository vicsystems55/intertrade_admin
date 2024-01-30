<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomDeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('salary_structure_id')->nullable();
            $table->string('name');
            $table->string('desc');
            $table->double('amount')->default(0);
            $table->double('per_deduct')->default(0);
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
        Schema::dropIfExists('custom_deductions');
    }
}

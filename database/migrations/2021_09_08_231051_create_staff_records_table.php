<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_records', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->string('bio')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('adddress')->nullable();
            $table->string('phone')->nullable();
        
            $table->string('nok_fullname')->nullable();
            $table->string('nok_address')->nullable();
            $table->string('nok_relationship')->nullable();
            $table->string('nok_phone')->nullable();

            $table->string('recipient_code')->nullable();
            $table->string('Auth_Code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('bank_code')->nullable();

            $table->string('status')->default('active');

            
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('staff_records');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBioDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_bio_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('state');
            $table->string('lga');
            $table->string('gender');
            $table->string('marital_status');

            $table->string('address');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('spouse_phone')->nullable();

            $table->string('ec_name');
            $table->string('ec_phone');
            $table->string('ec_address');

            $table->string('nok_name');
            $table->string('nok_phone');
            $table->string('nok_address');

            $table->string('date_employed');
            $table->string('position_held');

            $table->string('refree1_name');
            $table->string('refree1_phone');
            $table->string('refree1_address');

            $table->string('refree2_name')->nullable();
            $table->string('refree2_phone')->nullable();
            $table->string('refree2_address')->nullable();


















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
        Schema::dropIfExists('employee_bio_data');
    }
}

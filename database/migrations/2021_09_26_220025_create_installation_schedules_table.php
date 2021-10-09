<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallationSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installation_schedules', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('deployment_id')->unsigned();
       
            
            $table->date('installation_date')->nullable();

            $table->date('training_date')->nullable();

            $table->date('staff_trained')->nullable();

            $table->string('status')->default('not installed');

            $table->bigInteger('technician_assigned')->unsigned();


            $table->foreign('deployment_id')->references('id')->on('deployments');
           

            $table->foreign('technician_assigned')->references('id')->on('users');
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
        Schema::dropIfExists('installation_schedules');
    }
}

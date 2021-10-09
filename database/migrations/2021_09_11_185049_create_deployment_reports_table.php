<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeploymentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployment_reports', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('reporter_id')->unsigned();

            $table->string('state')->nullable();
            $table->string('site_name')->nullable();
            $table->string('model')->nullable();
            $table->string('installation_completion_date')->nullable();
            $table->string('ucc_serial_number')->nullable();
            $table->integer('staff_trained')->nullable();
            $table->string('rtmd_number')->nullable();
            $table->string('functional_state')->nullable();
            $table->string('temp_at_update')->nullable();
            $table->date('date_submitted')->nullable();
            $table->integer('units')->nullable();
            $table->longText('remark')->nullable();
            $table->string('report_code');
            $table->string('status')->default('not submitted');
            $table->foreign('reporter_id')->references('id')->on('users');
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
        Schema::dropIfExists('deployment_reports');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployments', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('project_id')->unsigned();

            $table->string('site_type')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('facility_address')->nullable();
            $table->string('facility_name')->nullable();
            $table->string('closet_town')->nullable();
            $table->string('project_OIC')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('no_ucc')->nullable();
            $table->string('road_access')->nullable();
            $table->string('ware_house_distance')->nullable();
            $table->string('road_quality')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('status')->default('Not delivered');

            $table->string('deployment_code')->default('ITL00000');

            $table->foreign('project_id')->references('id')->on('projects');
            
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
        Schema::dropIfExists('deployments');
    }
}

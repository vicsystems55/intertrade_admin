<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_routes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('deployment_id')->unsigned();
            $table->bigInteger('inventory_id')->unsigned();
            
            $table->date('pickup_date');

            $table->date('dropoff_date');

            $table->string('status')->default('not delivered');

            $table->bigInteger('driver_assigned')->unsigned();


            $table->foreign('deployment_id')->references('id')->on('deployments');
            $table->foreign('inventory_id')->references('id')->on('inventories');

            $table->foreign('driver_assigned')->references('id')->on('users');
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
        Schema::dropIfExists('truck_routes');
    }
}

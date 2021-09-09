<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_data', function (Blueprint $table) {
            $table->id();
            $table->string('site_type')->nullable();
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('facility_name')->nullable();
            $table->string('closet_town')->nullable();
            $table->string('oic_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('number_ucc_allocated')->nullable();
            $table->string('road_accessibility')->nullable();
            $table->string('distance_from_warehouse')->nullable();
            $table->string('quality_of_road')->nullable();
            $table->string('special_access_needs')->nullable();
            $table->string('other_needs')->nullable();
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('client_data');
    }
}
